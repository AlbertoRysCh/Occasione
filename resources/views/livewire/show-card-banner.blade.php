<div wire:init="loadCBanner">
   
    @if (count($card_banners))
        <div class="md:col-span-6 lg:col-span-6">
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-p">
                @foreach ($card_banners as $card_banner)
                @if($card_banner->tipo_card == "1")
                    <li class="">
                        <article>
                            @if($card_banner->description != null && $card_banner->link == null && $card_banner->link != " " && $card_banner->link_name == null && $card_banner->link_name != " ")
                                <a href="{{ $card_banner->description }}">
                            @elseif($card_banner->link != null && $card_banner->description == null && $card_banner->description != " "  && $card_banner->link_name == null && $card_banner->link_name != " ")
                                <a href="{{ route('categories.show_id', $card_banner->categories_slug) }}">
                            @elseif($card_banner->link_name != null && $card_banner->description == null && $card_banner->description != " "  && $card_banner->link == null && $card_banner->link != " ")
                                <a href="{{ route('products.show_id', $card_banner->products_slug) }}">
                            @else
                                <a>
                            @endif
                                <figure style="margin:0.15rem">
                                    <img class="h-40 w-full object-cover object-center image-card" src="{{ Storage::url($card_banner->image) }}" alt="">
                                </figure>
                            </a>
                        </article>
                    </li>
                @else
                <ul class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-p">
                    <li class="">
                        <article>
                            @if($card_banner->description != null && $card_banner->link == null && $card_banner->link != " " && $card_banner->link_name == null && $card_banner->link_name != " ")
                                <a href="{{ $card_banner->description }}">
                            @elseif($card_banner->link != null && $card_banner->description == null && $card_banner->description != " "  && $card_banner->link_name == null && $card_banner->link_name != " ")
                                <a href="{{ route('categories.show_id', $card_banner->categories_slug) }}">
                            @elseif($card_banner->link_name != null && $card_banner->description == null && $card_banner->description != " "  && $card_banner->link == null && $card_banner->link != " ")
                                <a href="{{ route('products.show_id', $card_banner->products_slug) }}">
                            @else
                                <a>
                            @endif
                                <figure style="margin:0.15rem">
                                    <img class="w-full object-cover object-center image-card" src="{{ Storage::url($card_banner->image) }}" alt="">
                                </figure>
                            </a>
                        </article>
                    </li>
                    <li class="">
                        <article>
                            @if($card_banner->s_description != null && $card_banner->s_link == null && $card_banner->s_link != " " && $card_banner->s_link_name == null && $card_banner->s_link_name != " ")
                                <a href="{{ $card_banner->s_description }}">
                            @elseif($card_banner->s_link != null && $card_banner->s_description == null && $card_banner->s_description != " "  && $card_banner->s_link_name == null && $card_banner->s_link_name != " ")
                                <a href="{{ route('categories.show_id', $card_banner->s_categories_slug) }}">
                            @elseif($card_banner->s_link_name != null && $card_banner->s_description == null && $card_banner->s_description != " "  && $card_banner->s_link == null && $card_banner->s_link != " ")
                                <a href="{{ route('products.show_id', $card_banner->s_products_slug) }}">
                            @else
                                <a>
                            @endif
                                <figure style="margin:0.15rem">
                                    <img class="h-40 w-full object-cover object-center image-card" src="{{ Storage::url($card_banner->s_image) }}" alt="">
                                </figure>
                            </a>
                        </article>
                    </li>
                </ul>
                @endif
                @endforeach 
            </ul>
        </div>
    @else

        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>

    @endif
</div>
