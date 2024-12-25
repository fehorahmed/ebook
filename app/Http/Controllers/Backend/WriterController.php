<?php

namespace App\Http\Controllers\Backend;

use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writers = Writer::get();
        return view('backend.dashboard.admin.pages.writer.index', compact('writers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dashboard.admin.pages.writer.create');
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
                $writer = new Writer();
                $writer->name = $request->name;
                $writer->status = $request->status;
                $writer->save();

            DB::commit();
            session()->flash('success', 'Writer has been Inserted successfully !!');
            return redirect()->route('writers.index');
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
        $writer = Writer::find($id);
        return view('backend.dashboard.admin.pages.writer.edit', compact('writer'));
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
                $writer = Writer::find($id);
                $writer->name = $request->name;
                $writer->status = $request->status;
                $writer->save();

            DB::commit();
            session()->flash('success', 'Writer has been Updated successfully !!');
            return redirect()->route('writers.index');
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
        $writer = Writer::find($id);
        if (is_null($writer)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('writers.index');
        }
        $writer->delete();
        session()->flash('success', 'Writer has been deleted successfully!!');
        return redirect()->route('writers.index');
    }
}
