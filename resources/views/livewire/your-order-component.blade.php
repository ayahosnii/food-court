<div>
    @foreach ($cartItems as $item)
        <li>{{$item->name}} (x{{$item['quantity']}}) <span>${{$item->newPrice ?? $item->price * $item['quantity']}}</span></li>
    @endforeach
</div>
