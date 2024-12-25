<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Gallery;
use App\Models\GalleryTopSection;
use App\Models\HomeSecondSection;
use App\Models\HomeThirdSection;
use App\Models\HomeVideo;
use App\Models\NavSection;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homeIndex(){
        $data = HomeVideo::first();
        $second = HomeSecondSection::first();
        $third = HomeThirdSection::first();
        $gallery = GalleryTopSection::first();
        $topGallery = Gallery::get();
        $navSection = NavSection::first();
        return view('backend.dashboard.admin.pages.home', compact('data', 'second','third', 'gallery', 'topGallery', 'navSection'));
    }

    public function homeStore(Request $request){

        $check = HomeVideo::first();
        if($check){
            if (!is_null($request->video)) {
                $check->video = UploadHelper::update('video', $request->video, '-' . time(), 'upload/videos', $check->video);
            }
            $check->save();
        }else{
            $checkRow = new HomeVideo();
            if (!is_null($request->video)) {
                $checkRow->video = UploadHelper::upload('video', $request->video, '-' . time(), 'upload/videos');
            }
            $checkRow->save();
        }
        session()->flash('success', 'Video has been updated successfully !!');
        return redirect()->back();
    }

    public function secondSection(Request $request){

        try {
            DB::beginTransaction();

            $content_exist = HomeSecondSection::first();
            if ($content_exist) {
                $content_exist->main_title = $request->main_title;
                $content_exist->sub_title = $request->sub_title;
                $content_exist->main_title_color = $request->main_title_color;
                $content_exist->sub_title_color = $request->sub_title_color;
                $content_exist->background_color = $request->background_color;
                $content_exist->button_text = $request->button_text;
                $content_exist->button_background_color = $request->button_background_color;
                $content_exist->button_hover_color = $request->button_hover_color;
                $content_exist->button_text_color = $request->button_text_color;
                $content_exist->button_text_hover_color = $request->button_text_hover_color;
                $content_exist->button_border_color = $request->button_border_color;
                $content_exist->button_hover_border_color = $request->button_hover_border_color;
                if (!is_null($request->section_image)) {
                    $content_exist->section_image = UploadHelper::update('section_image', $request->section_image, Str::slug($request->main_title) . '-' . time(), 'upload/second_section_image', $content_exist->section_image);
                }
                $content_exist->save();
            } else {
                $auth_content = new HomeSecondSection();
                $auth_content->main_title = $request->main_title;
                $auth_content->sub_title = $request->sub_title;
                $auth_content->main_title_color = $request->main_title_color;
                $auth_content->sub_title_color = $request->sub_title_color;
                $auth_content->background_color = $request->background_color;
                $auth_content->button_text = $request->button_text;
                $auth_content->button_background_color = $request->button_background_color;
                $auth_content->button_hover_color = $request->button_hover_color;
                $auth_content->button_text_color = $request->button_text_color;
                $auth_content->button_text_hover_color = $request->button_text_hover_color;
                $auth_content->button_border_color = $request->button_border_color;
                $auth_content->button_hover_border_color = $request->button_hover_border_color;

                if (!is_null($request->section_image)) {
                    $auth_content->section_image = UploadHelper::upload('section_image', $request->section_image, Str::slug($request->main_title) . '-' . time(), 'upload/second_section_image');
                }
                $auth_content->save();
            }

            DB::commit();
            session()->flash('success', 'Home Second Section has been updated successfully !!');
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function thirdSection(Request $request){

        try {
            DB::beginTransaction();

            $content_exist = HomeThirdSection::first();
            if ($content_exist) {
                $content_exist->top_title = $request->top_title;
                $content_exist->top_title_color = $request->top_title_color;
                $content_exist->description = $request->description;
                $content_exist->description_color = $request->description_color;
                $content_exist->background_color = $request->background_color;
                $content_exist->button_text = $request->button_text;
                $content_exist->button_background_color = $request->button_background_color;
                $content_exist->button_hover_color = $request->button_hover_color;
                $content_exist->button_text_color = $request->button_text_color;
                $content_exist->button_text_hover_color = $request->button_text_hover_color;
                $content_exist->button_border_color = $request->button_border_color;
                $content_exist->button_hover_border_color = $request->button_hover_border_color;
                if (!is_null($request->section_right_image)) {
                    $content_exist->section_right_image = UploadHelper::update('section_right_image', $request->section_right_image, Str::slug($request->top_title) . '-' . time(), 'upload/section_right_image', $content_exist->section_right_image);
                }
                $content_exist->save();
            } else {
                $auth_content = new HomeThirdSection();
                $auth_content->top_title = $request->top_title;
                $auth_content->top_title_color = $request->top_title_color;
                $auth_content->description = $request->description;
                $auth_content->description_color = $request->description_color;
                $auth_content->background_color = $request->background_color;
                $auth_content->button_text = $request->button_text;
                $auth_content->button_background_color = $request->button_background_color;
                $auth_content->button_hover_color = $request->button_hover_color;
                $auth_content->button_text_color = $request->button_text_color;
                $auth_content->button_text_hover_color = $request->button_text_hover_color;
                $auth_content->button_border_color = $request->button_border_color;
                $auth_content->button_hover_border_color = $request->button_hover_border_color;

                if (!is_null($request->section_right_image)) {
                    $auth_content->section_right_image = UploadHelper::upload('section_right_image', $request->section_right_image, Str::slug($request->main_title) . '-' . time(), 'upload/section_right_image');
                }
                $auth_content->save();
            }

            DB::commit();
            session()->flash('success', 'Home Third Section has been updated successfully !!');
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function gallerySection(Request $request){

        try {
            DB::beginTransaction();

            $content_exist = GalleryTopSection::first();
            if ($content_exist) {
                $content_exist->background_color = $request->background_color;
                $content_exist->button_text = $request->button_text;
                $content_exist->button_background_color = $request->button_background_color;
                $content_exist->button_hover_color = $request->button_hover_color;
                $content_exist->button_text_color = $request->button_text_color;
                $content_exist->button_text_hover_color = $request->button_text_hover_color;
                $content_exist->button_border_color = $request->button_border_color;
                $content_exist->button_hover_border_color = $request->button_hover_border_color;

                if (!is_null($request->section_left_image)) {
                    $content_exist->section_left_image = UploadHelper::update('gallery_section_image', $request->section_left_image, Str::random(15), 'upload/gallery_section_image/', $content_exist->section_left_image);
                }
                if (!is_null($request->section_right_top_image)) {
                    $content_exist->section_right_top_image = UploadHelper::update('gallery_section_image', $request->section_right_top_image, Str::random(15), 'upload/gallery_section_image/', $content_exist->section_right_top_image);
                }
                if (!is_null($request->section_right_bottom_left_image)) {
                    $content_exist->section_right_bottom_left_image = UploadHelper::update('gallery_section_image', $request->section_right_bottom_left_image, Str::random(15), 'upload/gallery_section_image/', $content_exist->section_right_bottom_left_image);
                }
                if (!is_null($request->section_right_bottom_right_image)) {
                    $content_exist->section_right_bottom_right_image = UploadHelper::update('gallery_section_image', $request->section_right_bottom_right_image, Str::random(15), 'upload/gallery_section_image/', $content_exist->section_right_bottom_right_image);
                }
                $content_exist->save();
            } else {
                $auth_content = new GalleryTopSection();
                $auth_content->background_color = $request->background_color;
                $auth_content->button_text = $request->button_text;
                $auth_content->button_background_color = $request->button_background_color;
                $auth_content->button_hover_color = $request->button_hover_color;
                $auth_content->button_text_color = $request->button_text_color;
                $auth_content->button_text_hover_color = $request->button_text_hover_color;
                $auth_content->button_border_color = $request->button_border_color;
                $auth_content->button_hover_border_color = $request->button_hover_border_color;

                if (!is_null($request->section_left_image)) {
                    $auth_content->section_left_image = UploadHelper::upload('gallery_section_image', $request->section_left_image, Str::random(15), 'upload/gallery_section_image/');
                }
                if (!is_null($request->section_right_top_image)) {
                    $auth_content->section_right_top_image = UploadHelper::upload('gallery_section_image', $request->section_right_top_image, Str::random(15), 'upload/gallery_section_image/');
                }
                if (!is_null($request->section_right_bottom_left_image)) {
                    $auth_content->section_right_bottom_left_image = UploadHelper::upload('gallery_section_image', $request->section_right_bottom_left_image, Str::random(15), 'upload/gallery_section_image/');
                }
                if (!is_null($request->section_right_bottom_right_image)) {
                    $auth_content->section_right_bottom_right_image = UploadHelper::upload('gallery_section_image', $request->section_right_bottom_right_image, Str::random(15), 'upload/gallery_section_image/');
                }
                $auth_content->save();
            }

            DB::commit();
            session()->flash('success', 'Gallery Section has been updated successfully !!');
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function topGallerySection(Request $request){
        try {
            DB::beginTransaction();
                $auth_content = new Gallery();
                $auth_content->top_title = $request->top_title;
                $auth_content->sub_title = $request->sub_title;
                $auth_content->background_color = $request->background_color;
                $auth_content->link = $request->link;
                if (!is_null($request->image)) {
                    $auth_content->image = UploadHelper::upload('image', $request->image, Str::slug($request->top_title) . '-' . time(), 'upload/top_section_image');
                }
                $auth_content->save();


            DB::commit();
            session()->flash('success', 'Home Second Section has been updated successfully !!');
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function subscribeCreate(){
        $subscribe = Subscribe::first();
        return view('backend.dashboard.admin.pages.subscribe', compact('subscribe'));
    }
    public function subscribeStore(Request $request){
        // dd($request->all());
        try {
            DB::beginTransaction();

            $subscribe = Subscribe::first();
            if ($subscribe) {
                $subscribe->title = $request->title;
                $subscribe->background_color = $request->background_color;
                $subscribe->button_text = $request->button_text;
                $subscribe->button_background_color = $request->button_background_color;
                $subscribe->button_hover_color = $request->button_hover_color;
                $subscribe->button_text_color = $request->button_text_color;
                $subscribe->button_text_hover_color = $request->button_text_hover_color;
                $subscribe->button_border_color = $request->button_border_color;
                $subscribe->button_hover_border_color = $request->button_hover_border_color;
                $subscribe->save();
            } else {
                $subscribe_new = new Subscribe();
                $subscribe_new->title = $request->title;
                $subscribe_new->background_color = $request->background_color;
                $subscribe_new->button_text = $request->button_text;
                $subscribe_new->button_background_color = $request->button_background_color;
                $subscribe_new->button_hover_color = $request->button_hover_color;
                $subscribe_new->button_text_color = $request->button_text_color;
                $subscribe_new->button_text_hover_color = $request->button_text_hover_color;
                $subscribe_new->button_border_color = $request->button_border_color;
                $subscribe_new->button_hover_border_color = $request->button_hover_border_color;
                $subscribe_new->save();
            }

            DB::commit();
            session()->flash('success', 'Subscribe Second Section has been updated successfully !!');
            return redirect()->route('subscribe_create');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function footerCreate(){
        $footer = Footer::first();
        return view('backend.dashboard.admin.pages.footer', compact('footer'));
    }

    public function footerStore(Request $request){
        // dd($request->all());
        try {
            DB::beginTransaction();

            $footer = Footer::first();
            if ($footer) {
                $footer->privacy_policy = $request->privacy_policy;
                $footer->term = $request->term;
                $footer->copy_right = $request->copy_right;
                $footer->copy_right_text_color = $request->copy_right_text_color;
                $footer->background_color = $request->background_color;
                $footer->text_color = $request->text_color;
                $footer->text_hover_color = $request->text_hover_color;
                $footer->about_us = $request->about_us;
                $footer->about_us_text_color = $request->about_us_text_color;
                $footer->phone = $request->phone;
                $footer->location = $request->location;
                $footer->email_one = $request->email_one;
                $footer->email_two = $request->email_two;
                $footer->location_text_color = $request->location_text_color;
                $footer->contact_text_color = $request->contact_text_color;
                $footer->social_icon_color = $request->social_icon_color;
                $footer->social_background_color = $request->social_background_color;
                $footer->footer_links_color = $request->footer_links_color;
                $footer->footer_links_hover_color = $request->footer_links_hover_color;
                $footer->save();
            } else {
                $footer_new = new Footer();
                $footer_new->privacy_policy = $request->privacy_policy;
                $footer_new->term = $request->term;
                $footer_new->copy_right = $request->copy_right;
                $footer_new->copy_right_text_color = $request->copy_right_text_color;
                $footer_new->background_color = $request->background_color;
                $footer_new->text_color = $request->text_color;
                $footer_new->text_hover_color = $request->text_hover_color;
                $footer_new->about_us = $request->about_us;
                $footer_new->about_us_text_color = $request->about_us_text_color;
                $footer_new->phone = $request->phone;
                $footer_new->location = $request->location;
                $footer_new->email_one = $request->email_one;
                $footer_new->email_two = $request->email_two;
                $footer_new->location_text_color = $request->location_text_color;
                $footer_new->contact_text_color = $request->contact_text_color;
                $footer_new->social_icon_color = $request->social_icon_color;
                $footer_new->social_background_color = $request->social_background_color;
                $footer_new->footer_links_color = $request->footer_links_color;
                $footer_new->footer_links_hover_color = $request->footer_links_hover_color;
                $footer_new->save();
            }

            DB::commit();
            session()->flash('success', 'Footer Second Section has been updated successfully !!');
            return redirect()->route('footer_create');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function navSectionStore(Request $request){
        try {
            DB::beginTransaction();

            $nav_section = NavSection::first();
            if ($nav_section) {
                $nav_section->text_color = $request->text_color;
                $nav_section->login_text_color = $request->login_text_color;
                $nav_section->login_hover_color = $request->login_hover_color;
                $nav_section->text_hover_color = $request->text_hover_color;
                $nav_section->background_color = $request->background_color;
                $nav_section->button_text = $request->button_text;
                $nav_section->button_background_color = $request->button_background_color;
                $nav_section->button_hover_color = $request->button_hover_color;
                $nav_section->button_text_color = $request->button_text_color;
                $nav_section->button_text_hover_color = $request->button_text_hover_color;
                $nav_section->button_border_color = $request->button_border_color;
                $nav_section->button_hover_border_color = $request->button_hover_border_color;
                $nav_section->save();
            } else {
                $nav_section_new = new NavSection();
                $nav_section_new->text_color = $request->text_color;
                $nav_section_new->login_text_color = $request->login_text_color;
                $nav_section_new->login_hover_color = $request->login_hover_color;
                $nav_section_new->text_hover_color = $request->text_hover_color;
                $nav_section_new->background_color = $request->background_color;
                $nav_section_new->button_text = $request->button_text;
                $nav_section_new->button_background_color = $request->button_background_color;
                $nav_section_new->button_hover_color = $request->button_hover_color;
                $nav_section_new->button_text_color = $request->button_text_color;
                $nav_section_new->button_text_hover_color = $request->button_text_hover_color;
                $nav_section_new->button_border_color = $request->button_border_color;
                $nav_section_new->button_hover_border_color = $request->button_hover_border_color;
                $nav_section_new->save();
            }

            DB::commit();
            session()->flash('success', 'Nav Section has been updated successfully !!');
            return redirect()->route('home.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }
}
