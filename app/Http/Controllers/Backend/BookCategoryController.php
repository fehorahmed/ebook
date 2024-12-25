<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BookCategory::get();
        return view('backend.dashboard.admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dashboard.admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        try {
            DB::beginTransaction();
                $category = new BookCategory();
                $category->name = $request->name;
                $category->status = $request->status;
                $category->save();

            DB::commit();
            session()->flash('success', 'Category has been Inserted successfully !!');
            return redirect()->route('book-category.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = BookCategory::find($id);
        return view('backend.dashboard.admin.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        try {
            DB::beginTransaction();
                $category = BookCategory::find($id);
                $category->name = $request->name;
                $category->status = $request->status;
                $category->save();

            DB::commit();
            session()->flash('success', 'Category has been Updated successfully !!');
            return redirect()->route('book-category.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = BookCategory::find($id);
        if (is_null($category)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('book-category.index');
        }
        $category->delete();
        session()->flash('success', 'Category has been deleted successfully!!');
        return redirect()->route('book-category.index');
    }
}
