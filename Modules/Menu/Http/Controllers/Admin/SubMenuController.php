<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\SubMenu;

class SubMenuController extends Controller
{
    public function index($slug)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $sub_menus = $menu->sub_menus()->orderBy('sort_id')->get();

        return view('menu::sub_menus.index', compact('menu', 'sub_menus'));
    }

    public function create($slug)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $sub_menus = $menu->sub_menus()->orderBy('sort_id')->get();

        return view('menu::sub_menus.create', compact('menu', 'sub_menus'));
    }

    public function store(Request $request, $slug)
    {
        dd($request->all());
        $menu = Menu::firstWhere('slug', $slug);

        $request->validate([

        ]);

        $sub_menu = $menu->sub_menus()->create($request->all());

        return redirect()->back()->with('success', 'منو با موفقیت اضافه شد');
    }

    public function edit($slug, $id)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $sub_menus = $menu->sub_menus()->orderBy('sort_id')->get();
        $sub_menu = SubMenu::findOrFail($id);

        return view('menu::sub_menus.edit', compact('sub_menu', 'sub_menus'));
    }

    public function update(Request $request, $slug, $id)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $sub_menu = SubMenu::findOrFail($id);

        $request->validate([

        ]);

        $sub_menu->update($request->all());

        return redirect()->back()->with('success', 'منو با موفقیت ویرایش شد');
    }

    public function destroy($slug, $id)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $sub_menu = SubMenu::findOrFail($id);
        $sub_menu->delete();

        return redirect()->back()->with('success', 'منو با موفقیت حذف شد');
    }
}
