<?php

namespace Modules\Payment\Traits;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Modules\Payment\Classes\MoneyFormatter;
use Symfony\Component\HttpFoundation\Response;

trait InvoiceTrait
{
    /**
     * Use this if the amount does not yet include tax.
     *
     * @param Int $amount The amount in cents, excluding taxes
     * @param String $description The description
     * @param Float $taxPercentage The tax percentage (i.e. 0.21). Defaults to 0
     * @return Illuminate\Database\Eloquent\Model  This instance after recalculation
     */
    public function addAmountExclTax($amount, $description, $taxPercentage = 0, $is_discount = false)
    {
        $tax = $amount * $taxPercentage;
        $this->lines()->create([
            'amount'         => $amount + $tax,
            'description'    => $description,
            'tax'            => $tax,
            'tax_percentage' => $taxPercentage,
            'is_discount'    => $is_discount,
        ]);

        return $this->recalculate();
    }

    /**
     * Use this if the amount already includes tax.
     *
     * @param Int $amount The amount in cents, including taxes
     * @param String $description The description
     * @param Float $taxPercentage The tax percentage (i.e. 0.21). Defaults to 0
     * @return Illuminate\Database\Eloquent\Model  This instance after recalculation
     */
    public function addAmountInclTax($amount, $description, $taxPercentage = 0, $is_discount = false)
    {
        $this->lines()->create([
            'amount'         => $amount,
            'description'    => $description,
            'tax'            => $amount - $amount / (1 + $taxPercentage),
            'tax_percentage' => $taxPercentage,
            'is_discount'    => $is_discount,
        ]);

        return $this->recalculate();
    }

    /**
     * Recalculates total and tax based on lines
     *
     * @return Illuminate\Database\Eloquent\Model  This instance
     */
    public function recalculate()
    {
        $this->total = $this->lines()->sum('amount');
        $this->tax   = $this->lines()->sum('tax');
        $this->save();

        return $this;
    }

    /**
     * Get the View instance for the invoice.
     *
     * @param array $data
     * @return \Illuminate\View\View
     */
    public function view(array $data = [])
    {
        return View::make('payment::receipt', array_merge($data, [
            'invoice'        => $this,
            'moneyFormatter' => new MoneyFormatter(
                $this->currency,
                config('payment.locale')
            ),
        ]));
    }

    /**
     * Capture the invoice as a PDF and return the raw bytes.
     *
     * @param array $data
     * @return string
     * @throws \Throwable
     */
    public function pdf(array $data = [])
    {
        if (! defined('DOMPDF_ENABLE_AUTOLOAD')) {
            define('DOMPDF_ENABLE_AUTOLOAD', false);
        }

        if (file_exists($configPath = base_path() . '/vendor/dompdf/dompdf/dompdf_config.inc.php')) {
            require_once $configPath;
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->view($data)->render());
        $dompdf->render();

        return $dompdf->output();
    }

    /**
     * Create an invoice download response.
     *
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function download(array $data = [])
    {
        $filename = $this->reference . '.pdf';

        return new Response($this->pdf($data), 200, [
            'Content-Description'       => 'File Transfer',
            'Content-Disposition'       => 'attachment; filename="' . $filename . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Type'              => 'application/pdf',
        ]);
    }

    public function addDiscount($voucher, $payment)
    {
        $paymentable = $payment->paymentable;

        if ((bool) $voucher->is_fixed) {
            $invoice = $this->addAmountExclTax(-$voucher->discount_amount, $voucher->description ?? 'تخفیف با کد', 0, true);
        } else {
            $discount_percent = ($voucher->discount_amount / 100);
            $model_price      = $paymentable->price ?? $paymentable->amount;
            $invoice          = $this->addAmountExclTax(-($model_price * (1 - $discount_percent)), 'تخفیف با کد', 0, true);
        }

        return $invoice;
    }

    public function getDiscountFinalPriceAttribute()
    {
    }
}
