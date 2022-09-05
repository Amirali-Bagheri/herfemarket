<?php

namespace Modules\Contact\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Contact\Entities\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('contact::admin.index', compact('contacts'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        if (!$contact) {
            return;
        }
        return redirect()->back()->with('success', 'پیام مورد نظر با موفقیت حذف گردید.');
    }

    public function deleteAll()
    {
    }

    public function export()
    {
    }

    public function destroy()
    {
    }

    public function search()
    {
    }
}
