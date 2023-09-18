    <div class="col-lg-3">
        <div class="hero__categories">
            <div class="hero__categories__all">
                <i class="fa fa-bars"></i>
                <span>All Courts</span>
            </div>
            <ul>
                @foreach ($provider->where('accountactivated', '1')->get() as $provider)
                    <li><a href="{{route('restaurant.details', ['slug'=> Str::slug($provider->name)])}}">{{$provider->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
