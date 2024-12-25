@php
    if(isset($$section_num)){
        $ar = json_decode($$section_num->decos, true);
    }
    $col = 6;
@endphp
<div class="row">
    @for($i = 0; $i <= $quantity - 1 ; $i++)
    @php
        if($i == ($quantity - 1) && $quantity%2 == 1){
            $col = 12;
        }
    @endphp
    <div class="col-md-{{ $col }}">
        <div class="form-group">
            <label for="decoration[{{ $i }}]" class="form-label"> Graphic #{{ $i + 1 }}</label>
            <select class="form-control select_bg" name="decoration[{{ $i }}]">
                <option value="" selected data-img_src="{{ asset('assets/public-site-v2/images/no-image.png') }}">No Image</option>
                @foreach (glob('assets/public-site-v2/images/decorations/*') as $j)
                    <option
                        value="{{ str_replace("assets/public-site-v2/images/decorations/", "", $j) }}"

                        data-img_src="{{ asset($j) }}"
                        @if(isset($ar) && isset($ar[$i]) && $ar[$i] == str_replace("assets/public-site-v2/images/decorations/", "", $j))
                            selected
                        @endif
                    >
                        {{ str_replace("assets/public-site-v2/images/decorations/", "", $j) }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endfor
</div>
