<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;


class CategoryController extends Controller
{
    public function showAdmin()
    {
        $categories = Category::all();
        $contacts = Contact::paginate(7);
        $keyword = '';
        $gender = null;
        $categoryId = null;
        $date = null;
        $exactMatch = false;
        return view('admin', compact('contacts', 'categories','keyword', 'gender', 'categoryId', 'date', 'exactMatch'));
    }

    public function search(SearchRequest $request)
    {
        $keyword = $request->input('keyword');
        $exactMatch = $request->input('exact_Match', false);
        $gender = $request->input('gender', 'all');
        $categoryId = $request->input('category_id');
        $date = $request->input('date');

        // dd($keyword, $gender, $categoryId, $date);

        // $contactsQuery = Contact::when($keyword, function ($query, $keyword) use ($exactMatch) {
        //     if ($exactMatch) {
        //         return $query->where(function ($q) use ($keyword) {
        //             $q->where('first_name', 'like', "%{$keyword}%")
        //                 ->orWhere('last_name', 'like', "%{$keyword}%")
        //                 ->orWhere('email', 'like', "%{$keyword}%");
        //         });
        //     } else {
        //         return $query->where(function ($q) use ($keyword) {
        //             $q->where('first_name', 'like', "%{$keyword}%")
        //                 ->orWhere('last_name', 'like', "%{$keyword}%")
        //                 ->orWhere('email', 'like', "%{$keyword}%");
        //         });
        //     }
        // })
        // ->when($gender !== 'all', function ($query) use ($gender) {
        //     return $query->where('gender', $gender);
        // })
        // ->when($categoryId, function ($query) use ($categoryId) {
        //     return $query->where('category_id', $categoryId);
        // })
        // ->when($date, function ($query) use ($date) {
        //     return $query->whereDate('created_at', $date);
        // });

        $contactsQuery = Contact::search($keyword, $exactMatch,
            $gender,
            $categoryId,
            $date
        );

        $contacts = $contactsQuery->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories','keyword', 'gender', 'categoryId', 'date', 'exactMatch'));
    }

    public function reset()
    {
        return redirect()->route('admin');
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('admin');
    }
}
