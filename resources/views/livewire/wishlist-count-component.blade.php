<li>
    <a href="{{route('cart')}}">
        <i class="fa fa-heart"></i>
        @if(auth()->check())
            <span>{{ $wishlistCount }}</span>
        @else
            <span>0</span>
        @endif
    </a>
</li>
