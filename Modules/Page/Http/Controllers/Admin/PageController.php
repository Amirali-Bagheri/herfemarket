<?php

namespace Modules\Page\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\Page\Entities\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);

        return view('page::admin.index', compact('pages'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('page::admin.create');
        }

        return $request->all();

        $page = Page::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'status' => $request['status'],
            'content' => $request['body'],
        ]);

        $page->save();

        return redirect()->route('admin.pages.index')->with(['success' => 'صفحه مورد نظر با موفقیت ایجاد شد.']);
    }

    public function update(Request $request, $slug)
    {
        if ($request->isMethod('get')) {
            $page = Page::firstWhere('slug', $slug);

            return view('page::admin.update', compact('page'));
        }
        $page = Page::firstWhere('slug', $slug);

        $request->validate([
            'status' => 'required',
        ]);

        $page->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'status' => $request['status'],
            'content' => $request['body'],
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'صفحه مورد نظر با موفقیت ویرایش شد.');
    }

    public function destroy($id)
    {
        try {
            Page::findOrFail($id)->delete();
        } catch (Exception $e) {
            return redirect()->route('admin.pages.index')->with('error', $e->getMessage());
        }

        return redirect()->route('admin.pages.index')->with('success', 'صفحه مورد نظر با موفقیت حذف گردید.');
    }

    public function search(Request $request)
    {
        $pages = Page::where('title', 'LIKE', "%{$request->input('s')}%")
            ->orWhere('slug', 'LIKE', "%{$request->input('s')}%")
            ->paginate(10);

        return view('page::admin.index', compact('pages'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request['ids'];

        Page::whereIn('id', explode(",", $ids))->delete();

        return response()->json([
            'status' => true,
            'message' => "صفحات مورد نظر با موفقیت حذف گردید.",
        ]);
    }
}
