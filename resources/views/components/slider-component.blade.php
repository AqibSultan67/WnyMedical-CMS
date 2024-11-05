
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            {{-- <div class="carousel-item active" data-interval="5000">
                <a href="" target="_blank">
        <img src="https://comwnymedical.s3.amazonaws.com/uploads/public/60e/b1f/4a3/60eb1f4a35006625137344.jpg" class="d-block w-100" alt="..."></a>
            </div> --}}
            @foreach($sliders as $index => $slider)
            <div class="carousel-item @if($index == 0) active @endif" data-interval="5000">
                <img src="{{ asset('storage/slider-images/' . $slider->image) }}" class="d-block w-100" alt="Slider Image">
            </div>
        @endforeach
            {{-- <div class="carousel-item" data-interval="5000">
                <img src="https://comwnymedical.s3.amazonaws.com/media/book%20your%20appointment.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="https://comwnymedical.s3.amazonaws.com/media/new%20location%201.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="https://comwnymedical.s3.amazonaws.com/uploads/public/60e/b1f/b5a/60eb1fb5a6a21618512162.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="https://comwnymedical.s3.amazonaws.com/uploads/public/60e/b1f/070/60eb1f070b5f4653561362.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <img src="https://comwnymedical.s3.amazonaws.com/uploads/public/60e/b20/862/60eb208627593249813720.jpg" class="d-block w-100" alt="...">
            </div> --}}


        </div>
    </div>

