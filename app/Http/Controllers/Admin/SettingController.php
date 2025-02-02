<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Footer;
use App\Models\Social;
use App\Models\Setting;
use App\Models\AdSetting;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PricingSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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


    public function adSetting(){
        $adCheck = AdSetting::first();
        return view('backend.dashboard.admin.ad_setting.add',compact('adCheck'));
    }

    public function adSettingCreateOrUpdate(Request $request){
        $adCheck = AdSetting::first();
        if($adCheck){
            $adCheck->update([
                'details_page_ad_one' => $request->details_page_ad_one,
                'details_page_ad_two' => $request->details_page_ad_two,
                'details_page_ad_three' => $request->details_page_ad_three,
                'details_page_ad_four' => $request->details_page_ad_four,
                'details_page_ad_five' => $request->details_page_ad_five,
                'details_page_ad_six' => $request->details_page_ad_six,
            ]);
        }else{
            AdSetting::create([
                'details_page_ad_one' => $request->details_page_ad_one,
                'details_page_ad_two' => $request->details_page_ad_two,
                'details_page_ad_three' => $request->details_page_ad_three,
                'details_page_ad_four' => $request->details_page_ad_four,
                'details_page_ad_five' => $request->details_page_ad_five,
                'details_page_ad_six' => $request->details_page_ad_six,
            ]);
        }
        session()->flash('success', 'Ad Updated Successfully!');
        return redirect()->back();
    }

    public function homePageAdSettingCreateOrUpdate(Request $request){
        $adCheck = AdSetting::first();
        if($adCheck){
            $adCheck->update([
                'home_page_ad_one' => $request->home_page_ad_one,
                'home_page_ad_two' => $request->home_page_ad_two,
                'home_page_ad_three' => $request->home_page_ad_three,
                'home_page_ad_four' => $request->home_page_ad_four,
                'home_page_ad_five' => $request->home_page_ad_five,
                'home_page_ad_six' => $request->home_page_ad_six,
            ]);
        }else{
            AdSetting::create([
                'home_page_ad_one' => $request->home_page_ad_one,
                'home_page_ad_two' => $request->home_page_ad_two,
                'home_page_ad_three' => $request->home_page_ad_three,
                'home_page_ad_four' => $request->home_page_ad_four,
                'home_page_ad_five' => $request->home_page_ad_five,
                'home_page_ad_six' => $request->home_page_ad_six,
            ]);
        }
        session()->flash('success', 'Home Page Ad Updated Successfully!');
        return redirect()->back();
    }
    public function categoryPageAdSettingCreateOrUpdate(Request $request){
        $adCheck = AdSetting::first();
        if($adCheck){
            $adCheck->update([
                'category_page_ad_one' => $request->category_page_ad_one,
                'category_page_ad_two' => $request->category_page_ad_two,
                'category_page_ad_three' => $request->category_page_ad_three,
                'category_page_ad_four' => $request->category_page_ad_four,
                'category_page_ad_five' => $request->category_page_ad_five,
            ]);
        }else{
            AdSetting::create([
                'category_page_ad_one' => $request->category_page_ad_one,
                'category_page_ad_two' => $request->category_page_ad_two,
                'category_page_ad_three' => $request->category_page_ad_three,
                'category_page_ad_four' => $request->category_page_ad_four,
                'category_page_ad_five' => $request->category_page_ad_five,
            ]);
        }
        session()->flash('success', 'Catgory Page Ad Updated Successfully!');
        return redirect()->back();
    }
    public function writerPageAdSettingCreateOrUpdate(Request $request){
        $adCheck = AdSetting::first();
        if($adCheck){
            $adCheck->update([
                'writer_page_ad_one' => $request->writer_page_ad_one,
                'writer_page_ad_two' => $request->writer_page_ad_two,
                'writer_page_ad_three' => $request->writer_page_ad_three,
                'writer_page_ad_four' => $request->writer_page_ad_four,
                'writer_page_ad_five' => $request->writer_page_ad_five,
            ]);
        }else{
            AdSetting::create([
                'writer_page_ad_one' => $request->writer_page_ad_one,
                'writer_page_ad_two' => $request->writer_page_ad_two,
                'writer_page_ad_three' => $request->writer_page_ad_three,
                'writer_page_ad_four' => $request->writer_page_ad_four,
                'writer_page_ad_five' => $request->writer_page_ad_five,
            ]);
        }
        session()->flash('success', 'Writer Page Ad Updated Successfully!');
        return redirect()->back();
    }

    public function singlePageAdSettingCreateOrUpdate(Request $request){
        $adCheck = AdSetting::first();
        if($adCheck){
            $adCheck->update([
                'single_page_ad_one' => $request->single_page_ad_one,
                'single_page_ad_two' => $request->single_page_ad_two,
                'single_page_ad_three' => $request->single_page_ad_three,
                'single_page_ad_four' => $request->single_page_ad_four,
                'single_page_ad_five' => $request->single_page_ad_five,
            ]);
        }else{
            AdSetting::create([
                'single_page_ad_one' => $request->single_page_ad_one,
                'single_page_ad_two' => $request->single_page_ad_two,
                'single_page_ad_three' => $request->single_page_ad_three,
                'single_page_ad_four' => $request->single_page_ad_four,
                'single_page_ad_five' => $request->single_page_ad_five,
            ]);
        }
        session()->flash('success', 'Single Page Ad Updated Successfully!');
        return redirect()->back();
    }
}
