@foreach($banners as $banner)
    <div class="single-banner-slide" style="background-image: url({{ asset('assets/img/hero/' . $banner->background_image) }});">
        <h2>{{$banner->title}}</h2>
        <p>
            {{$banner->description}}
        </p>
        <a href="{{route('reservation')}}">Book Now!</a>
    </div>
@endforeach
