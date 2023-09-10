<div>
    @foreach ($cartItems as $item)
        <li>{{$item->name}} (x{{$item['quantity']}}) <span>${{$item->price * $item['quantity']}}</span></li>
    @endforeach
</div>
