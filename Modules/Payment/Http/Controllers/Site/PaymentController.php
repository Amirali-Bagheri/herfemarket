<?php

namespace Modules\Payment\Http\Controllers\Site;

use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Business\Entities\Business;
use Modules\Payment\Entities\Payment;
use Modules\Plan\Entities\Plan;
use Modules\User\Entities\User;
use SoapClient;

class PaymentController extends Controller
{
    /**
     * @throws Exception
     */
    public function redirect()
    {


//        // $order_id = Crypt::decrypt($order_id);
//
//        $payment = Payment::where('user_id', auth()->id())->where('order_id', $order_id)->firstOrFail();
//        $invoice = Invoice::findByReference($order_id);
//
//        // $invoice = Invoice::where('user_id', auth()->id())->where('reference', $order_id)->firstOrFail();
//
//        // $user_id = Crypt::decrypt($user_id);
//        // $user    = User::firstWhere('md5', $user_id);
//        //
//        // $plan = Plan::firstWhere('slug', $slug);
//        //
//        // $subscription      = $user->getSubscription();
//        // $subscription_plan = $user->getPlan();
//        //
//        // $price = $plan->price;
//        // // $price = 1500;
//        // $resNum = md5(microtime());
//        //
//        // $payment = Payment::create(
//        //     [
//        //         'paymentable_id'   => $plan->id,
//        //         'paymentable_type' => Plan::class,
//        //         'user_id'          => $user->id,
//        //         'price'            => price_t2r($price),
//        //         'order_id'         => 'YL-' . verta()->timestamp,
//        //         'transaction_id'   => $resNum,
//        //         // 'token'   => $token,
//        //         'currency'         => 'IRT',
//        //         'provider'         => 'saman',
//        //         'ip'               => request()->ip(),
//        //     ]);
//
//
//        if (empty($invoice)) {
//            $final_price = $payment->price;
//        } else {
//            $final_price = $invoice->total;
//        }
//
//        $token = Http::withHeaders([
//            'Content-Type' => 'application/json',
//        ])->withOptions([
//            'verify' => false,
//        ])->post('https://sep.shaparak.ir/MobilePG/MobilePayment', [
//            'Action'      => 'Token',
//            'Amount'      => price_t2r((int) $final_price),
//            // 'Wage'            => '',
//            // 'AffectiveAmount' => '',
//            'TerminalId'  => env('SEP_MWRCHANT_ID'),
//            'ResNum'      => $payment->transaction_id,
//            'RedirectURL' => env('SEP_CALLBACK_URL'),
//            'CellNumber'  => $payment->user->mobile,
//        ]);
//
//        $token = $token['token'] ?? null;
//
//        if (!$token) {
//
//        // return redirect()->route('dashboard.payment.invoice', $payment->order_id);
//
//            return redirect()->route('dashboard.index')->with('error', 'پرداخت با خطا مواجه شد!');
//        }
//        //
//        // $payment = Payment::create(
//        //     [
//        //         'paymentable_id'   => $plan->id,
//        //         'paymentable_type' => Plan::class,
//        //         'user_id'          => $user->id,
//        //         'price'            => price_t2r($price),
//        //         'order_id'         => 'YL-' . verta()->timestamp,
//        //         'transaction_id'   => $resNum,
//        //         // 'token'   => $token,
//        //         'currency'         => 'IRT',
//        //         'provider'         => 'saman',
//        //         'ip'               => request()->ip(),
//        //     ]);
//        //
//
//        return view('payment::redirect_gateway', [
//                'token' => $token,
//            ]);
    }

    public function sep(Request $request)
    {
        $TerminalId = $request->TerminalId;
        $RefNum = $request->RefNum;
        $ResNum = $request->ResNum;
        $State = $request->State;
        $TraceNo = $request->TraceNo;
        $Amount = $request->Amount;
        $Rrn = $request->Rrn;
        $SecurePan = $request->SecurePan;
        $Token = $request->Token;
        $HashedCardNumber = $request->HashedCardNumber;
        $Status = $request->Status;
        $AffectiveAmount = $request->AffectiveAmount;

        if (!(isset($State) and !empty($State) and $State == "OK")) {
            return redirect()->route('dashboard.plans')->with('error', 'پرداخت با خطا مواجه شد.');

            // if ($user->getPlan()->id == $plan->id) {
            //     $user->subscription('main')->active();
            // } else {
            // $user->newSubscription('main', $plan);

            // }
            //            $request->session()->regenerate(true);
            //            // $request->session()->invalidate();'
            //            if ( \Illuminate\Support\Facades\Auth::attempt(['mobile' => convert2english($user->mobile), 'password' => $user->password], true)) {
            //                request()->session()->regenerate();
            //
            //
            //                return redirect()->route('dashboard.plans')->with('success', 'پرداخت با موفقیت انجام شد');
            //            } else {
            //                dd('test',Auth::user());
            //            }

            // return redirect()->intended(route('site.index'))->with('success', 'پرداخت با موفقیت انجام شد');
        }

        $soapclient = new SoapClient('https://verify.sep.ir/Payments/ReferencePayment.asmx?WSDL');
        $res = $soapclient->VerifyTransaction($RefNum, env('SEP_MWRCHANT_ID'));

        if ($res <= 0) {
            return redirect()->route('dashboard.plans')->with('error', 'پرداخت با خطا مواجه شد.');
        }

        // Transaction Successful

        $payment = Payment::firstWhere('transaction_id', $ResNum);

        if (!$payment) {
            return redirect()->route('dashboard.plans')->with('error', 'پرداخت با خطا مواجه شد.');
        }

        $user = User::find($payment->user_id);
        Auth::login($user, true);

        $payment->update([
            'ref_id' => $RefNum,
            'tracking_code' => $TraceNo,
            'card_number' => $SecurePan,
            'status' => $Status,
        ]);

        if ((int)$Status == 2) {
            $plan = Plan::find($payment->paymentable_id);

            $subscription = $user->getSubscription();
            $subscription_plan = $user->getPlan();

            $subscription->changePlan($plan);
            $subscription->renew();

            return redirect()->route('dashboard.plans')->with('success', 'پرداخت با موفقیت انجام شد');
        }


        return redirect()->route('dashboard.plans')->with('error', 'پرداخت با خطا مواجه شد.');

        // if ($user->getPlan()->id == $plan->id) {
        //     $user->subscription('main')->active();
        // } else {
        // $user->newSubscription('main', $plan);

        // }
        //            $request->session()->regenerate(true);
        //            // $request->session()->invalidate();'
        //            if ( \Illuminate\Support\Facades\Auth::attempt(['mobile' => convert2english($user->mobile), 'password' => $user->password], true)) {
        //                request()->session()->regenerate();
        //
        //
        //                return redirect()->route('dashboard.plans')->with('success', 'پرداخت با موفقیت انجام شد');
        //            } else {
        //                dd('test',Auth::user());
        //            }

        // return redirect()->intended(route('site.index'))->with('success', 'پرداخت با موفقیت انجام شد');
    }
}
