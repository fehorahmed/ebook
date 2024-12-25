@extends('backend.layouts.backend_master')
@section('title')
   
@endsection
@section('styles')
    
@endsection

@section('admin-content')
<section>
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Auth Page</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                            {{-- <a href="{{ route('users.index') }}" class="btn btn-info float-right">back to list</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('auth_page_update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Background Image</label>
                                    <input type="file" name="background_image" id="background_image" data-height="100" class="form-control dropify" data-default-file="{{ isset($authContent->background_image) ? asset('upload/auth_image/'.$authContent->background_image) : null }}">
                                    @error('background_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Background Color</label>
                                    <input type="color" name="background_color" value="{{ old('background_color', $authContent->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                    @error('text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Color</label>
                                    <input type="color" name="button_background_color" value="{{ old('button_background_color', $authContent->button_background_color ?? '') }}" id="button_background_color" class="form-control w-100" style="height: 60px;">
                                    @error('text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Hover Color</label>
                                    <input type="color" name="button_hover_color" value="{{ old('button_hover_color', $authContent->button_hover_color ?? '') }}" id="button_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text Hover Color</label>
                                    <input type="color" name="button_text_hover_color" value="{{ old('button_text_hover_color', $authContent->button_text_hover_color ?? '') }}" id="button_text_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Border Color</label>
                                    <input type="color" name="button_border_color" value="{{ old('button_border_color', $authContent->button_border_color ?? '') }}" id="button_border_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text Color</label>
                                    <input type="color" name="button_text_color" id="button_text_color" value="{{ old('button_text_color', $authContent->button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Hover Border Color</label>
                                    <input type="color" name="button_hover_border_color" value="{{ old('button_hover_border_color', $authContent->button_hover_border_color ?? '') }}" id="button_hover_border_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Google Button Background Color</label>
                                    <input type="color" name="google_button_background_color" value="{{ old('google_button_background_color', $authContent->google_button_background_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Google Button Hover Color</label>
                                    <input type="color" name="google_button_hover_color" data-height="150" value="{{ old('google_button_hover_color', $authContent->google_button_hover_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Google Button Text Color</label>
                                    <input type="color" name="google_button_text_color" value="{{ old('google_button_text_color', $authContent->google_button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Google Button Text Hover Color</label>
                                    <input type="color" name="google_button_text_hover_color" data-height="150" value="{{ old('google_button_text_hover_color', $authContent->google_button_text_hover_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Google Button Border Color</label>
                                    <input type="color" name="google_button_border_color" value="{{ old('google_button_border_color', $authContent->google_button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Google Button Hover Border Color</label>
                                    <input type="color" name="google_button_hover_border_color" data-height="150" value="{{ old('google_button_hover_border_color', $authContent->google_button_hover_border_color ?? '') }}"  class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Input Background Color</label>
                                    <input type="color" name="input_background_color" value="{{ old('input_background_color', $authContent->input_background_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Input Border Color</label>
                                    <input type="color" name="input_border_color" data-height="150" value="{{ old('input_border_color', $authContent->input_border_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Input Placeholder Color</label>
                                    <input type="color" name="input_placeholder_color" value="{{ old('input_placeholder_color', $authContent->input_placeholder_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Card Background Color</label>
                                    <input type="color" name="card_background_color" value="{{ old('card_background_color', $authContent->card_background_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Forget Password Link Color</label>
                                    <input type="color" name="forgot_password_link_color" data-height="150" value="{{ old('forgot_password_link_color', $authContent->forgot_password_link_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Forget Password Link Hover Color</label>
                                    <input type="color" name="forgot_password_link_hover_color" value="{{ old('forgot_password_link_hover_color', $authContent->forgot_password_link_hover_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Agreement Color</label>
                                    <input type="color" name="agreement_color" data-height="150" value="{{ old('agreement_color', $authContent->agreement_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Agreement Link Color</label>
                                    <input type="color" name="agreement_link_color" value="{{ old('agreement_link_color', $authContent->agreement_link_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Agreement Link Hover Color</label>
                                    <input type="color" name="agreement_link_hover_color" data-height="150" value="{{ old('agreement_link_hover_color', $authContent->agreement_link_hover_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Input Field Input Text Color</label>
                                    <input type="color" name="input_placeholder_click_color" data-height="150" value="{{ old('input_placeholder_click_color', $authContent->input_placeholder_click_color ?? '') }}" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Border Color</label>
                                    <input type="color" name="button_border_color" id="button_border_color" value="{{ old('button_border_color', $navSection->button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>

                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                            </div>
                        </div>
                       </div>
                    </form>
            </div>
        </div>
    </div>
</section>



@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();

            $('#users_table').DataTable({
                aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        'bSortable': false,
                        'bSearchable': false,
                        "className": "text-center",
                        'aTargets': [-1]
                    }
                ]
            });
        });
    </script>
@endsection