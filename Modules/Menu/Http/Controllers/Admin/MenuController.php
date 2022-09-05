<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate(20);

        return view('menu::menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menu::menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'منو با موفقیت ثبت شد');
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        $sub_menus = $menu->sub_menus()->orderBy('sort_id')->get();

        return view('menu::menus.edit', compact('menu', 'sub_menus'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        $sub_menus = $menu->sub_menus()->orderBy('sort_id')->get();

        return view('menu::menus.show', compact('menu', 'sub_menus'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:menus,slug,$menu->id,id",
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'منو با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->sub_menus()->delete();
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'منو با موفقیت حذف شد');
    }
}
