<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\PricingSetting;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Image;

class SettingController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function settingPage()
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $settingData = Setting::first();
        return view('backend.dashboard.admin.settings.settings', compact('settingData'));
    }

    public function uploadLogoMedia(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $urls = [];
        foreach ($request->images as $image) {
            array_push($urls, temporaryImageUpload($image));
        }
        return response()->json(['success' => true, 'urls' => $urls]);
    }

    public function removeLogoMedia(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        if ($request->fromStorage == true) {
            $originalImagePath = str_replace('/t/', '/o/', $request->image);
            imageDelete($originalImagePath);
            $listImagePath = str_replace('/t/', '/l/', $request->image);
            imageDelete($listImagePath);
            return response()->json(['success' => imageDelete($request->image)]);
        } else {
            return response()->json(['success' => removeTemporaryImage($request->image)]);
        }
    }
    public function logoMediaUpload(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $itemInputImages = json_decode($request->site_logo, true);
        $setting = Setting::first();
        if (!$setting) {
            $setting  = Setting::create([
                'site_logo' => null
            ]);
        }
        if ($itemInputImages && $itemInputImages[0]['site_logo']) {
            $mediaImage = imageMove($itemInputImages[0]['site_logo'], $folderName = 'site_logo', $imageStoreTypes = ['originalSize']);
            $originalSize = $mediaImage['originalSize'];

            $setting->site_logo = $originalSize;
            $setting->save();
            return response()->json(['success' => true, 'message' => 'Logo has been uploaded successfully !!'], 200);
        } else {
            $setting->site_logo = null;
            $setting->save();
            return response()->json(['success' => true, 'message' => 'Logo has been uploaded successfully !!'], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'site_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $setting = Setting::first();
        if($setting){
            $imageName = $setting->site_logo;
            if($request->hasFile('site_logo')){
                $imageName = time().'.'.$request->site_logo->extension();
                $request->site_logo->move(public_path('upload/site_logo'), $imageName);
            }
            $imageNameTwo = $setting->admin_logo;
            if($request->hasFile('admin_logo')){
                $imageNameTwo = time().'.'.$request->admin_logo->extension();
                $request->admin_logo->move(public_path('upload/site_logo'), $imageNameTwo);
            }

            $setting->update([
                'site_logo' => $imageName,
                'admin_logo' => $imageNameTwo
            ]);
       }else{
            $imageName = '';
            if($request->hasFile('site_logo')){
                $imageName = time().'.'.$request->site_logo->extension();
                $request->site_logo->move(public_path('upload/site_logo'), $imageName);
            }
            $imageNameTwo = '';
            if($request->hasFile('admin_logo')){
                $imageNameTwo = time().'.'.$request->admin_logo->extension();
                $request->admin_logo->move(public_path('upload/site_logo'), $imageNameTwo);
            }
            Setting::create([
                'site_logo' => $imageName,
                'admin_logo' => $imageNameTwo,

            ]);
       }

        return response()->json(['success' => true, 'message' => 'Logo uploaded successfully !!'], 200);
    }

    public function footerTopsUpload(Request $request)
    {
    $request->validate([
        // 'footer_top_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $footer = Footer::first();
    if($footer){
        $imageName = $footer->footer_top_image;
        if($request->hasFile('footer_top_image')){
            $imageName = time().'.'.$request->footer_top_image->extension();
            $request->footer_top_image->move(public_path('upload/footer_top_image'), $imageName);
        }
        $imageNameTwo = $footer->footer_middle_image;
        if($request->hasFile('footer_middle_image')){
            $imageNameTwo = time().'.'.$request->footer_middle_image->extension();
            $request->footer_middle_image->move(public_path('upload/footer_middle_image'), $imageNameTwo);
        }

        $footer->update([
            'footer_top_image' => $imageName,
            'footer_middle_image' => $imageNameTwo
        ]);
    }else{
        $imageName = '';
        if($request->hasFile('footer_top_image')){
            $imageName = time().'.'.$request->footer_top_image->extension();
            $request->footer_top_image->move(public_path('upload/footer_top_image'), $imageName);
        }
        $imageNameTwo = '';
        if($request->hasFile('footer_middle_image')){
            $imageNameTwo = time().'.'.$request->footer_middle_image->extension();
            $request->footer_middle_image->move(public_path('upload/footer_middle_image'), $imageNameTwo);
        }
        Footer::create([
            'footer_top_image' => $imageName,
            'footer_middle_image' => $imageNameTwo,

        ]);
    }

    return response()->json(['success' => true, 'message' => 'Images uploaded successfully !!'], 200);
}

    public function compose(View $view)
    {
        $setting = Setting::first();
        $view->with('site_logo', ($setting && $setting->site_logo ? asset('upload/site_logo/'.$setting->site_logo) : asset('wb.png')));
    }

    public function social(Request $request)
    {
        $social = Social::first();
        return view('backend.dashboard.admin.socials.social', compact('social'));
    }
    public function socialStore(Request $request){
        try {
            DB::beginTransaction();

            $content_exist = Social::first();
            if ($content_exist) {
                $content_exist->facebook = $request->facebook;
                $content_exist->instagram = $request->instagram;
                $content_exist->twitter = $request->twitter;
                $content_exist->youtube = $request->youtube;
                $content_exist->tiktok = $request->tiktok;
                $content_exist->linkedin = $request->linkedin;
                $content_exist->save();
            } else {
                $social = new Social();
                $social->facebook = $request->facebook;
                $social->instagram = $request->instagram;
                $social->twitter = $request->twitter;
                $social->youtube = $request->youtube;
                $social->tiktok = $request->tiktok;
                $social->linkedin = $request->linkedin;
                $social->save();
            }

            DB::commit();
            session()->flash('success', 'Social has been updated successfully !!');
            return redirect()->route('social');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function pricing(){
        $pricing = PricingSetting::first();
        return view('backend.dashboard.admin.pricing_setting.pricing', compact('pricing'));
    }

    public function pricingStore(Request $request){
        $request->validate([
            'basic_video_per_minute_price' => 'required|numeric',
            'pro_animation_video_per_minute_price' => 'required|numeric',
            'youtube_video_per_minute_price' => 'required|numeric',
            'fast_delivery_price' => 'required|numeric',
            'corporate_video_per_minute_price' => 'required|numeric',
        ]);
        try {
            DB::beginTransaction();

            $content_exist = PricingSetting::first();
            if ($content_exist) {
                $content_exist->basic_video_per_minute_price = $request->basic_video_per_minute_price;
                $content_exist->pro_animation_video_per_minute_price = $request->pro_animation_video_per_minute_price;
                $content_exist->youtube_video_per_minute_price = $request->youtube_video_per_minute_price;
                $content_exist->fast_delivery_price = $request->fast_delivery_price;
                $content_exist->corporate_video_per_minute_price = $request->corporate_video_per_minute_price;
                $content_exist->save();
            } else {
                $pricing_setting = new PricingSetting();
                $pricing_setting->basic_video_per_minute_price = $request->basic_video_per_minute_price;
                $pricing_setting->pro_animation_video_per_minute_price = $request->pro_animation_video_per_minute_price;
                $pricing_setting->youtube_video_per_minute_price = $request->youtube_video_per_minute_price;
                $pricing_setting->fast_delivery_price = $request->fast_delivery_price;
                $pricing_setting->corporate_video_per_minute_price = $request->corporate_video_per_minute_price;
                $pricing_setting->save();
            }

            DB::commit();
            session()->flash('success', 'Pricing has been updated successfully !!');
            return redirect()->route('pricing_setting');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }
}
