<?php

namespace Modules\Payment\Http\Controllers\Admin;

use App\Exports\InquiriesExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\Entities\Payment;

class PaymentController extends Controller
{
    public function delete($id)
    {
        $inquiry = Payment::findOrFail($id);

        $inquiry->delete();

        return redirect()->route('admin.payments.index')->with('success', 'استعلام مورد نظر با موفقیت حذف گردید.');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Payment::whereIn('id', explode(",", $ids))->delete();

        return response()->json([
            'status' => true,
            'message' => "استعلام های مورد نظر با موفقیت حذف گردید.",
        ]);
    }

    public function update(Request $request)
    {
        $inquiry = Payment::findOrFail($request->id);

        if ($request['status'] == 1) {
            if (!$inquiry->isApproved()) {
                $inquiry->markApproved();
                $success = true;
                $message = "استعلام مورد نظر با موفقیت تایید شد";
            }
        } elseif ($request['status'] == 2) {
            if (!$inquiry->isRejected()) {
                $inquiry->markRejected();
                $success = true;
                $message = "استعلام مورد نظر با موفقیت رد شد";
            }
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function export()
    {
        return Excel::download(new InquiriesExport(), '_payments.xlsx');
    }

    public function search(Request $request)
    {
        $payments = Payment::where('description', 'LIKE', "%{$request->input('s')}%")
            ->orwhere('title', 'LIKE', "%{$request->input('s')}%")
            ->paginate(10);

        return view('payment::admin.index', compact('payments'));
    }
}
