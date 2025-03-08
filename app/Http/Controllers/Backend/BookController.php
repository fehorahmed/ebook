<?php

namespace App\Http\Controllers\Backend;

use App\Models\Book;
use App\Models\Writer;
use Illuminate\Support\Str;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Models\BookPageContent;
use App\Models\AdManage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('writer','category')->get();
        // dd($books);
        return view('backend.dashboard.admin.pages.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BookCategory::where('status', 1)->get();
        $writers = Writer::where('status', 1)->get();
        return view('backend.dashboard.admin.pages.book.create', compact('writers','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:books,name',
            'status' => 'required',
            'short_description' => 'required',
            'image' => 'required',
            'ad_link' => 'required|string|max:255',
            'ad_count' => 'required|numeric',
            'ad_coin' => 'required|numeric',
            // 'content_name' => 'required|array',
            'content_name.*' => 'required|string|max:255',
            // 'description' => 'required|array',
            'description.*' => 'required|string|max:20000',

        ]);
        try {
            DB::beginTransaction();
                $book = new Book();
                $book->name = $request->name;
                $book->category_id = $request->category_id;
                $book->writer_id = $request->writer_id;
                $book->description = $request->short_description;
                $book->slug = Str::slug($request->name,'-');
                $book->ad_link = $request->ad_link;
                $book->ad_count = $request->ad_count;
                $book->ad_coin = $request->ad_coin;
                $book->status = $request->status;
                if (!is_null($request->image)) {
                    $book->image = UploadHelper::upload('book_image', $request->image, Str::slug($request->name) . '-' . time(), 'upload/book_image');
                }
                $book->save();
                $counter = 0;
                foreach($request->content_name as $content){
                    BookPageContent::create([
                        'book_id' => $book->id,
                        'content_name' => $request->content_name[$counter],
                        'description' => $request->description[$counter],
                        'slug' => Str::slug($request->content_name[$counter],'-'),
                    ]);
                    $counter++;
                }
                // $counter = 0;
                // foreach($request->ad_link as $content){
                //     AdManage::create([
                //         'book_id' => $book->id,
                //         'ad_link' => $request->ad_link[$counter],
                //     ]);
                //     $counter++;
                // }

            DB::commit();
            session()->flash('success', 'Book has been Inserted successfully !!');
            return redirect()->route('book.index');
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
    public function edit(Book $book)
    {
        $categories = BookCategory::where('status', 1)->get();
        $writers = Writer::where('status', 1)->get();
        return view('backend.dashboard.admin.pages.book.edit', compact('writers','categories','book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Book $book, Request $request)
    {
        // 'name' => 'required|unique:books,name,except,id',
        $request->validate([
            'name' => 'required|unique:books,name,'.$book->id,
            'status' => 'required',
            'short_description' => 'required',
            'image' => 'nullable|image|max:1024',
            'ad_link' => 'required|string|max:255',
            'ad_count' => 'required|numeric',
            'ad_coin' => 'required|numeric',
        ]);
        try {
            DB::beginTransaction();

                $book->name = $request->name;
                $book->category_id = $request->category_id;
                $book->writer_id = $request->writer_id;
                $book->description = $request->short_description;
                $book->slug = Str::slug($request->name,'-');
                $book->status = $request->status;
                $book->ad_link = $request->ad_link;
                $book->ad_count = $request->ad_count;
                $book->ad_coin = $request->ad_coin;
                if (!is_null($request->image)) {
                    $book->image = UploadHelper::upload('book_image', $request->image, Str::slug($request->name) . '-' . time(), 'upload/book_image');
                }
                $book->save();
                $counter = 0;
                foreach($book->bookPageContent as $content){
                    $content->update([
                        'content_name' => $request->content_name[$counter],
                        'description' => $request->description[$counter]
                    ]);
                    $counter++;
                }

            DB::commit();
            session()->flash('success', 'Book has been Updated successfully !!');
            return redirect()->route('book.index');
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
        $book = Book::find($id);
        if (is_null($book)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('book.index');
        }
        if($book->image){
            UploadHelper::deleteFile('upload/book_image/' . $book->image);
        }

        BookPageContent::where('book_id', $id)->delete();

        $book->delete();

        session()->flash('success', 'Book has been deleted successfully!!');
        return redirect()->route('book.index');
    }
}
