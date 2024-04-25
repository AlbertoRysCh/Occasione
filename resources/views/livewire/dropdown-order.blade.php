<?php
use App\Models\Order;
?>
<x-jet-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.*')">
    <span class="relative inline-block cursor-pointer">
        {{ __('Orders') }}

        <span
            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-3/4 -translate-y-1/2 bg-red-600 rounded-full">
            {{ $recibido = Order::where('status', 2)->count() }}
        </span>
    </span>
</x-jet-nav-link>
