<style>
    .book {
        float: left;
        width: 20%;
        margin: 10px;
        box-shadow: 0px 0px 6px -2px #000000a6;
        border-radius: 10px;
        overflow: hidden;
    }

    .book img {
        margin: 0 auto;
        display: block;
    }

    .book span {
        float: left;
        padding: 15px;
        text-align: center;
        margin: 0 auto;
        display: block;
    }
</style>

@foreach ($searchData as $sd)

    <div class="book">
        <a href="/book/details/{{ encrypt($sd->id) }}">
            <img src="{{ asset('upload/book_image/'.$sd->image) }}" alt="Book Cover">
            <span>
                {{ $sd->name }}
            </span>
        </a>
    </div>

@endforeach