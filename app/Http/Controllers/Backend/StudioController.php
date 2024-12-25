<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Helpers\UploadHelper;
use App\Models\Gallery;
use App\Models\Studio;
use App\Models\StudioHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StudioController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($isTrashed = false)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $studio = Studio::get();
        return view('backend.dashboard.admin.pages.studio.index', compact('studio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $studio = Studio::get();
        $studioHeader = StudioHeader::first();
        return view('backend.dashboard.admin.pages.studio.create', compact('studio', 'studioHeader'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        try {
            DB::beginTransaction();
                $studio = new Studio();
                $studio->background_color = $request->background_color;
                $studio->title = $request->title;
                $studio->genre = $request->genre;
                if (!is_null($request->image)) {
                    $studio->image = UploadHelper::upload('image', $request->image, Str::slug($request->title) . '-' . time(), 'upload/studio');
                }
                $studio->save();

            DB::commit();
            session()->flash('success', 'Team Section has been Inserted successfully !!');
            return redirect()->route('studio.create');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $editData = Studio::find($id);
        return view('backend.dashboard.admin.pages.studio.edit', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        try {
            DB::beginTransaction();
                $studio = Studio::find($id);
                $studio->background_color = $request->background_color;
                $studio->title = $request->title;
                $studio->genre = $request->genre;
                if (!is_null($request->image)) {
                    $studio->image = UploadHelper::update('image', $request->image, Str::slug($request->title) . '-' . time(), 'upload/studio', $studio->image);
                }
                $studio->save();

            DB::commit();
            session()->flash('success', 'Team Section has been updated successfully !!');
            return redirect()->route('studio.create');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $studio = Studio::find($id);
        if (is_null($studio)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('studio.create');
        }
        if($studio->image){
            UploadHelper::deleteFile('upload/studio/' . $studio->image);
        }

        $studio->delete();

        session()->flash('success', 'Team has been deleted successfully!!');
        return redirect()->route('studio.create');
    }

    public function studioHeaderUpdate(Request $request){
        $check = StudioHeader::first();
        if($check){
            $check->update([
                'top_title' => $request->top_title,
                'sub_title' => $request->sub_title,
                'top_title_text_color' => $request->top_title_text_color,
                'background_color' => $request->background_color
            ]);
        }else{
            StudioHeader::create([
                'top_title' => $request->top_title,
                'sub_title' => $request->sub_title,
                'top_title_text_color' => $request->top_title_text_color,
                'background_color' => $request->background_color
            ]);
        }
        session()->flash('success', 'Team Header has been Updated successfully!!');
        return redirect()->route('studio.create');
    }
}
