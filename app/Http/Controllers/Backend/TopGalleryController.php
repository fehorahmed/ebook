<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Helpers\UploadHelper;
use App\Models\Gallery;
use App\Models\GalleryHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TopGalleryController extends Controller
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
        $topGallery = Gallery::get();
        return view('backend.dashboard.admin.pages.top_gallery.index', compact('topGallery'));
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
        $topGallery = Gallery::get();
        $galleryHeader = GalleryHeader::first();
        return view('backend.dashboard.admin.pages.top_gallery.create', compact('topGallery', 'galleryHeader'));
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
            $topGallery = new Gallery();
            if (!is_null($request->image)) {
                $topGallery->image = UploadHelper::upload('image',$request->image, Str::random(15), 'upload/portfolio');
            }

            if (!is_null($request->video)) {
                $topGallery->video = UploadHelper::upload('video',$request->video, Str::random(15), 'upload/portfolio');
            }
            $topGallery->background_color = $request->background_color;
            $topGallery->save();

            DB::commit();
            session()->flash('success', 'Portfolio Section has been Inserted successfully !!');
            return redirect()->route('top-gallery.create');
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
        $editData = Gallery::find($id);
        return view('backend.dashboard.admin.pages.top_gallery.edit', compact('editData'));
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
            $topGallery = Gallery::find($id);
            if (!is_null($request->image)) {
                $topGallery->image = UploadHelper::update('image', $request->image, Str::random(15), 'upload/portfolio', $topGallery->image);
            }
            if (!is_null($request->video)) {
                $topGallery->video = UploadHelper::update('video', $request->video, Str::random(15), 'upload/portfolio', $topGallery->video);
            }
            $topGallery->background_color = $request->background_color;
            $topGallery->save();

            DB::commit();
            session()->flash('success', 'Portfolio Section has been updated successfully !!');
            return redirect()->route('top-gallery.create');
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

        $gallery = Gallery::find($id);
        if (is_null($gallery)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('top-gallery.create');
        }
        if($gallery->image){
            UploadHelper::deleteFile('upload/portfolio/' . $gallery->image);
        }
        if($gallery->video){
            UploadHelper::deleteFile('upload/portfolio/' . $gallery->video);
        }
        $gallery->delete();

        session()->flash('success', 'Portfolio has been deleted successfully!!');
        return redirect()->route('top-gallery.create');
    }

    public function galleryHeaderUpdate(Request $request)
    {
        // dd($request->all());
        $check = GalleryHeader::first();
        if ($check) {
            $check->update([
                'top_title' => $request->top_title,
                'sub_title' => $request->sub_title,
                'background_color' => $request->background_color,
                'top_title_text_color' => $request->top_title_text_color,
                'sub_title_text_color' => $request->sub_title_text_color
            ]);
        } else {
            GalleryHeader::create([
                'top_title' => $request->top_title,
                'sub_title' => $request->sub_title,
                'background_color' => $request->background_color,
                'top_title_text_color' => $request->top_title_text_color,
                'sub_title_text_color' => $request->sub_title_text_color
            ]);
        }
        session()->flash('success', 'Portfolio Header has been Updated successfully!!');
        return redirect()->route('top-gallery.create');
    }
}
