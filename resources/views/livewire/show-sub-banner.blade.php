<div wire:init="loadSBanner">
    @if (count($subbanners))
        <div class="glider-contain">
            <ul class="glidersb-{{$subbanner}}">
                @foreach ($subbanners as $subbanner)
                    @if($subbanner->description != null && $subbanner->link == null && $subbanner->link != " " && $subbanner->link_name == null && $subbanner->link_name != " ")
                        <a href="{{ $subbanner->description }}">
                    @elseif($subbanner->link != null && $subbanner->description == null && $subbanner->description != " "  && $subbanner->link_name == null && $subbanner->link_name != " ")
                        <a href="{{ route('categories.show_id', $subbanner->categories_slug) }}">
                    @elseif($subbanner->link_name != null && $subbanner->description == null && $subbanner->description != " "  && $subbanner->link == null && $subbanner->link != " ")
                        <a href="{{ route('products.show_id', $subbanner->products_slug) }}">
                    @else
                        <a>
                    @endif
                        <figure class="mr-2 ml-2">
                            <img class="h-full w-full object-cover object-center" src="{{ Storage::url($subbanner->image) }}" alt="">
                        </figure>
                    </a>
                @endforeach

            </div>

            <button aria-label="Previous" class="glider-prev"></button>
            <button aria-label="Next" class="glider-next"></button>
            <div role="tablist" class="dots"></div>
        </div>
    @else

        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>

    @endif
</div>
