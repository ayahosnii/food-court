<div>
    @foreach ($cartItems as $item)
        @php
            $price = $item->sales->isNotEmpty()
                ? number_format($item->price * (100 - $item->sales->first()->percentage) / 100, 2)
                : $item->price;
        @endphp

        <li>
            {{ $item->name }} (x{{ $item['quantity'] }}) <span>${{ $item->newPrice ?? $price * $item['quantity'] }}</span>
        </li>
    @endforeach
</div>
