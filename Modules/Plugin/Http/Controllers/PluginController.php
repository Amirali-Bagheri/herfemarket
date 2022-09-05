<?php

namespace Modules\Plugin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;

class PluginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $plugins = collect(Module::all())->paginate(10);

//        dd(Module::collections()->has('Landing'));

//        return Module::allEnabled();
//        return Module::collections()->has('Business');


        return view('plugin::index')->with('plugins', $plugins);
    }

    public function update(Request $request, $name)
    {
        $module = Module::findOrFail((string)$name);

        if (Module::collections()->has($name)) {
            $module->disable();
        } else {
            $module->enable();
        }

        return back()->with('success', 'ویرایش با موفقیت اعمال شد.');
    }

    public function delete(Request $request, $name)
    {
        $module = Module::findOrFail((string)$name);

        if (Module::collections()->has($name)) {
            $module->disable();
        }

        $module->delete();

        return back()->with('success', 'مورد انتخابی با موفقیت حذف شد.');
    }
}
