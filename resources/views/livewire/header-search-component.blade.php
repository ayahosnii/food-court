<div class="hero__search">
    <div class="hero__search__form">
        <form action="{{route('meal.search')}}">
            <input type="text" name="q" placeholder="Search for items....." value="{{$q}}">
            <button style="background-color: #735845" type="submit" class="site-btn">SEARCH</button>
        </form>
    </div>
    <div class="hero__search__phone">
        <div class="hero__search__phone__icon">
            <i class="fa fa-phone"></i>
        </div>
        <div class="hero__search__phone__text">
            <h5>+20 11.188.888</h5>
            <span>support 24/7 time</span>
        </div>
    </div>
</div>


