<?php

namespace Modules\Comments\Http\Controllers\Admin;

use App\Exports\CommentsExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Comments\Entities\Comment;
use Modules\Product\Entities\Product;

class CommentsController extends Controller
{
    public function index()
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/comments')
         * @name('admin.comments.index')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $comments = Comment::withAnyStatus()->latest()->paginate(10);

        //  $comment = Comment::find(1);
        // return $comment->product-;
        return view('comments::admin.index', compact('comments'));
    }

    public function delete($id, Request $request)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/comments/delete/{id}')
         * @name('comments.delete')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $comment = Comment::withAnyStatus()->findOrFail($id);

        $comment->delete();

        if (! $comment) {
            return;
        }

        return redirect()->route('admin.comments.index')->with('success', 'دیدگاه مورد نظر با موفقیت حذف گردید.');
    }

    public function deleteAll(Request $request)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/comments/deleteAll')
         * @name('comments.deleteAll')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $ids = $request->ids;
        Comment::whereIn('id', explode(",", $ids))->withAnyStatus()->delete();

        return response()->json([
            'status'  => true,
            'message' => "دیدگاه های مورد نظر با موفقیت حذف گردید.",
        ]);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::withAnyStatus()->findOrFail($id);

        if ($request['status'] == 1) {
            if (! $comment->isApproved()) {
                $comment->markApproved();
                $success = true;
                $message = "دیدگاه مورد نظر تایید شد";
            }
        } elseif ($request['status'] == 2) {
            if (! $comment->isRejected()) {
                $comment->markRejected();
                $success = true;
                $message = "دیدگاه مورد نظر رد شد";
            }
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function export()
    {
        /**
         * @get('/admin/comments/export')
         * @name('comments.export')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        return Excel::download(new CommentsExport(), 'comments.xlsx');
    }

    public function search(Request $request)
    {
        $comments = Comment::withAnyStatus()->where('body', 'LIKE', "%{$request->input('s')}%")->paginate(10);

        return view('comments::admin.index', compact('comments'));
    }

    public function reply(Request $request)
    {
        $reply       = new Comment();
        $reply->body = $request->get('body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');

        if (auth()->user()->role_id == 1) {
            $reply->status = 1;
        }
        $product = Product::find($request->get('product_id'));

        $result = $product->comments()->save($reply);

        if ($result) {
            $success = true;
            $message = "دیدگاه شما با موفقیت ثبت شد";
        } else {
            $success = false;
            $message = "خطایی در ارسال دیدگاه رخ داد!";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
