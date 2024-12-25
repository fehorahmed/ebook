<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyTerm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivacyTermController extends Controller
{
    public function index(){
        $privacy = PrivacyTerm::where('page_type', 1)->first();
        // dd($privacy);
        return view('backend.dashboard.admin.pages.privacy', compact('privacy'));
    }


    public function termIndex(){
        $term = PrivacyTerm::where('page_type', 2)->first();
        return view('backend.dashboard.admin.pages.term', compact('term'));
    }

    public function store(Request $request){
        if($request->page_type == 1){
            $check = PrivacyTerm::where('page_type', 1)->first();
            if($check)
            {
                $check->update([
                    'main_title' => $request->main_title,
                    'page_type' => $request->page_type,
                    'description' => $request->description
                ]);
            }
            else
            {
            $check = PrivacyTerm::create([
                    'main_title' => $request->main_title,
                    'page_type' => $request->page_type,
                    'description' => $request->description
                ]);
            }
            session()->flash('success', 'Privacy has been updated successfully !!');
            return redirect()->back();
        }else{
            
            $check = PrivacyTerm::where('page_type', 2)->first();
            if($check)
            {
                $check->update([
                    'main_title' => $request->main_title,
                    'page_type' => $request->page_type,
                    'description' => $request->description
                ]);
            }
            else
            {
            $check = PrivacyTerm::create([
                    'main_title' => $request->main_title,
                    'page_type' => $request->page_type,
                    'description' => $request->description
                ]);
            }
            session()->flash('success', 'Term has been updated successfully !!');
            return redirect()->back();
        }
    }
}
