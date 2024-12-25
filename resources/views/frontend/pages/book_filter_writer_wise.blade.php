<div class="row mt-2" id="book_filter" style="width: 100%">
    @foreach ($writerWiseBooks as $book)
        <div class="col-md-2">
            <a href="{{ route('book_details', encrypt($book->id)) }}">
                <div class="card shadow card_height">
                    <img src="{{ (!empty($book->image)) ? asset('upload/book_image/'. $book->image) : null }}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <p class="card-text">{{ $book->name ?? '' }}-{{ $book->writer->name ?? '' }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

    @php
        if(count($writerWiseBooks) == 0){
            @endphp
            <center>
                <div class="alert alert-warning" role="alert">
                    <span>Data Not Found</span>
                </div>
            </center>
            @php
        }
    @endphp



</div>
