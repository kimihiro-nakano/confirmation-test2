<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    public function showAdmin()
    {
        $categories = Category::all();
        $contacts = Contact::paginate(7);
        return view('admin', compact('contacts', 'categories'));
    }

    public function search(ContactRequest $request)
    {
        $query = Contact::query();
        $query->nameEmailSearch($request)->get();

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();

        return redirect('/admin');
    }
}