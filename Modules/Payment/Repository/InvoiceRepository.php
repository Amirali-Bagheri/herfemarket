<?php

namespace Modules\Payment\Repository;

use Carbon\Carbon;
use DB;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;
use Modules\Analytics\Entities\Click;
use Modules\Business\Entities\Business;
use Modules\Payment\Entities\Invoice;
use Modules\Product\Entities\ProductPrices;
use Throwable;

class InvoiceRepository
{
    public function create_invoice_for_all_not_requested_businesses()
    {
        $v = verta()->timezone('Asia/Tehran')->subMonth();
        $start = Verta::createJalali($v->year, $v->month, 1, 00, 00, 00)->timezone('Asia/Tehran');
        $end_month = $start->addMonth()->subDay();
        $end = Verta::createJalali($v->year, $end_month->month, $end_month->day, 23, 59, 59)->timezone('Asia/Tehran');
        $gStart = Carbon::instance($start->datetime())->timezone('Asia/Tehran');
        $gEnd = Carbon::instance($end->datetime())->timezone('Asia/Tehran');

        try {
            DB::beginTransaction();
            $total_amount = 0;
            $total_click_count = 0;
            foreach (Business::where('status', 1)->where('invoice_request', 0)->get() as $business_without_invoice_request) {
                $clicks = Click::whereHasMorph('clickable', [ProductPrices::class], function (Builder $query) use ($business_without_invoice_request) {
                    $query->where('business_id', $business_without_invoice_request->id);
                })->whereBetween('created_at', [$gStart, $gEnd])->get();

                $clicks_total = $clicks->count() * setting('withdraw_business_visit');
                $total = ceil($clicks_total / 1.09);

                $total_amount += $total;
                $total_click_count += count($clicks);
            }

            $invoice_number = str_pad(Invoice::query()->count() + 1, 5, "0", STR_PAD_LEFT);

            $invoice = Invoice::create([
                'isPaymentable' => true,
                'status' => 1,
                'currency' => 'IRR',
                'total' => price_t2r((int)$total_amount),
                'tax' => 0,
                'note' => 'صورتحساب ماهیانه دوره ' . $start->format('Y/m/d') . ' تا ' . $end->format('Y/m/d') .
                    ' ( ' . $total_click_count . ' کلیک )'
                ,
                'invoice_number' => $invoice_number,
            ]);

            $invoice->lines()->create([
                'amount' => price_t2r((int)$total_amount),
                'description' => 'صورتحساب ماهیانه دوره ' . $start->format('Y/m/d') . ' تا ' . $end->format('Y/m/d') .
                    ' ( ' . $total_click_count . ' کلیک )'
                ,
            ]);

            DB::commit();

            return true;
        } catch (Throwable $exception) {
            DB::rollback();
            throw $exception;
        }
    }

    public function create_invoice_for_businesses_has_requested()
    {
        $v = verta()->timezone('Asia/Tehran')->subMonth();
        $start = Verta::createJalali($v->year, $v->month, 1, 00, 00, 00)->timezone('Asia/Tehran');
        $end_month = $start->addMonth()->subDay();
        $end = Verta::createJalali($v->year, $end_month->month, $end_month->day, 23, 59, 59)->timezone('Asia/Tehran');
        $gStart = Carbon::instance($start->datetime())->timezone('Asia/Tehran');
        $gEnd = Carbon::instance($end->datetime())->timezone('Asia/Tehran');

        foreach (Business::where('status', 1)->where('invoice_request', 1)->get() as $business_with_invoice_request) {
            try {
                DB::beginTransaction();

                $clicks = Click::whereHasMorph('clickable', [ProductPrices::class], function (Builder $query) use ($business_with_invoice_request) {
                    $query->where('business_id', $business_with_invoice_request->id);
                })->whereBetween('created_at', [$gStart, $gEnd])->get();

                $clicks_total = $clicks->count() * setting('withdraw_business_visit');
                $total = ceil($clicks_total / 1.09);
                $invoice_number = str_pad(Invoice::query()->count() + 1, 5, "0", STR_PAD_LEFT);

                $invoice = Invoice::create([
                    'isPaymentable' => true,
                    'user_id' => $business_with_invoice_request->manager_id,
                    'invoicable_type'=> Business::class,
                    'invoicable_id'=> $business_with_invoice_request->id,
                    'status' => 1,
                    'currency' => 'IRR',
                    'total' => price_t2r((int)$total),
                    'tax' => 0,
                    'note' => 'صورتحساب ماهیانه دوره ' . $start->format('Y/m/d') . ' تا ' . $end->format('Y/m/d') .
                        ' ( ' . $clicks->count() . ' کلیک )'
                    ,
                    'invoice_number' => $invoice_number,
                ]);

                $invoice->lines()->create([
                    'amount' => price_t2r((int)$total),
                    'description' => 'صورتحساب ماهیانه دوره ' . $start->format('Y/m/d') . ' تا ' . $end->format('Y/m/d') .
                        ' ( ' . $clicks->count() . ' کلیک )'
                    ,
                ]);
                DB::commit();
            } catch (Throwable $exception) {
                DB::rollback();
                throw $exception;
            }
        }

        return true;
    }
}
