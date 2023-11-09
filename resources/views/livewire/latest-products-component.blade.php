<div>
    <div class="latest-product__text">
        <h4>Latest Products</h4>
        <div class="latest-product__slider owl-carousel">
            <div class="latest-product__slider owl-carousel">
                @foreach($lastSixMeals->chunk(3) as $mealsChunk)
                    <div class="latest-prdouct__slider__item">
                        @foreach($mealsChunk as $meal)
                            <a href="{{route('meals.details', ['slug'=>$meal->slug])}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{$meal->image}}" alt="{{ $meal->name }}">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $meal->name }}</h6>
                                    @if ($meal->sales->isNotEmpty())
                                        <span><del>${{$meal->price}}</del></span>
                                        <span>${{ number_format($meal->price * (100 - $meal->sales->first()->percentage) / 100, 2) }}</span>
                                    @else
                                        <span>${{$meal->price}}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
