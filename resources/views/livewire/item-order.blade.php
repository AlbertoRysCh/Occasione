    <?php
    $configs = DB::table('configs')->first();
    
    if ($configs != null) {
        $money = DB::table('locations')
            ->where([['id', '=', $configs->location_id]])
            ->value('money');
    } else {
        $money = 'USD';
        $dif_precio = 'x%';
    }
    
    ?>

    <div class="mt-2 mb-2">
        <ul class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @foreach ($items as $item)
                <li class="flex justify-center px-2 py-2 border-b w-full md:w-100 border-gray-200">
                    <div class="block md:flex">
                        <div class="flex md:w-full justify-center items-center mb-2 mt-5">
                            <img class="h-20 w-20 md:h-40 md:w-40 object-cover mr-4" src="{{ $item->options->image }}"
                                alt="">
                        </div>
                        <div class="m-4">
                            <article class="flex-1">
                                <h1 class="font-bold">{{ $item->name }}</h1>

                                <div class="flex">
                                    <p>Cant: {{ $item->qty }}</p>

                                    @isset($item->options->color)
                                        <p class="mx-2"> Color: {{ __($item->options->color) }}</p>
                                    @endisset

                                    @isset($item->options->size)
                                        <p> - {{ $item->options->size }}</p>
                                    @endisset
                                </div>

                                @if (isset($item->sub_price) && ($item->sub_price != null || $item->sub_price != 0.0))
                                    <div class="flex">
                                        <p class="text-s"
                                            style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">
                                            {{ $money }} {{ number_format($item->sub_price, 2) }}</p>

                                        <small class="ml-2">-{{ $item->porcentaje }}%</small>
                                    </div>
                                    <p class="text-op">{{ $money }} {{ number_format($item->price, 2) }}
                                    </p>
                                @else
                                    <p class="text-op">{{ $money }}
                                        {{ number_format($item->price, 2) }} </p>
                                @endif
                            </article>
                        </div>
                </li>
            @endforeach
        </ul>

    </div>
