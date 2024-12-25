<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\AuthContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function authPage(){
        $authContent = AuthContent::first();
        return view('backend.dashboard.admin.auth.auth_page', compact('authContent'));
    }

    public function authPageStore(Request $request){
        try {
            DB::beginTransaction();

            $content_exist = AuthContent::first();
            if ($content_exist) {
                $content_exist->background_color = $request->background_color;
                $content_exist->button_background_color = $request->button_background_color;
                $content_exist->button_hover_color = $request->button_hover_color;
                $content_exist->button_text_color = $request->button_text_color;
                $content_exist->button_text_hover_color	 = $request->button_text_hover_color;
                $content_exist->button_border_color = $request->button_border_color;
                $content_exist->button_hover_border_color = $request->button_hover_border_color;
                $content_exist->google_button_background_color = $request->google_button_background_color;
                $content_exist->google_button_hover_color = $request->google_button_hover_color;
                $content_exist->google_button_text_color = $request->google_button_text_color;
                $content_exist->google_button_text_hover_color = $request->google_button_text_hover_color;
                $content_exist->google_button_border_color = $request->google_button_border_color;
                $content_exist->google_button_hover_border_color = $request->google_button_hover_border_color;
                $content_exist->input_background_color = $request->input_background_color;
                $content_exist->input_border_color = $request->input_border_color;
                $content_exist->input_placeholder_color = $request->input_placeholder_color;
                $content_exist->input_placeholder_click_color = $request->input_placeholder_click_color;
                $content_exist->card_background_color = $request->card_background_color;
                $content_exist->forgot_password_link_color = $request->forgot_password_link_color;
                $content_exist->forgot_password_link_hover_color = $request->forgot_password_link_hover_color;
                $content_exist->agreement_color = $request->agreement_color;
                $content_exist->agreement_link_color = $request->agreement_link_color;
                $content_exist->agreement_link_hover_color = $request->agreement_link_hover_color;
                if (!is_null($request->background_image)) {
                    $content_exist->background_image = UploadHelper::update('background_image', $request->background_image, '-' . time(), 'upload/auth_image', $content_exist->background_image);
                }
                $content_exist->save();
            } else {
                $auth_content = new AuthContent();
                $auth_content->background_color = $request->background_color;
                $auth_content->button_background_color = $request->button_background_color;
                $auth_content->button_hover_color = $request->button_hover_color;
                $auth_content->button_text_color = $request->button_text_color;
                $auth_content->button_text_hover_color	 = $request->button_text_hover_color;
                $auth_content->button_border_color = $request->button_border_color;
                $auth_content->button_hover_border_color = $request->button_hover_border_color;
                $auth_content->google_button_background_color = $request->google_button_background_color;
                $auth_content->google_button_hover_color = $request->google_button_hover_color;
                $auth_content->google_button_text_color = $request->google_button_text_color;
                $auth_content->google_button_text_hover_color = $request->google_button_text_hover_color;
                $auth_content->google_button_border_color = $request->google_button_border_color;
                $auth_content->google_button_hover_border_color = $request->google_button_hover_border_color;
                $auth_content->input_background_color = $request->input_background_color;
                $auth_content->input_border_color = $request->input_border_color;
                $auth_content->input_placeholder_color = $request->input_placeholder_color;
                $auth_content->input_placeholder_click_color = $request->input_placeholder_click_color;
                $auth_content->card_background_color = $request->card_background_color;
                $auth_content->forgot_password_link_color = $request->forgot_password_link_color;
                $auth_content->forgot_password_link_hover_color = $request->forgot_password_link_hover_color;
                $auth_content->agreement_color = $request->agreement_color;
                $auth_content->agreement_link_color = $request->agreement_link_color;
                $auth_content->agreement_link_hover_color = $request->agreement_link_hover_color;

                if (!is_null($request->background_image)) {
                    $auth_content->background_image = UploadHelper::upload('background_image', $request->background_image, '-' . time(), 'upload/auth_image');
                }
                $auth_content->save();
            }

            DB::commit();
            session()->flash('success', 'Auth Content has been updated successfully !!');
            return redirect()->route('auth_page');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }
}
