
<div wire:init="loadcPosts">
   
    @if (count($sliders))
        <div class="glider-contain">
            <div class="glider">
                @foreach ($sliders as $slider)
                    @if($slider->description != null && $slider->link == null && $slider->link != " " && $slider->link_name == null && $slider->link_name != " ")
                        <a href="{{ $slider->description }}" class="link-update">
                    @elseif($slider->link != null && $slider->description == null && $slider->description != " "  && $slider->link_name == null && $slider->link_name != " ")
                        <a href="{{ route('categories.show_id', $slider->categories_slug) }}" class="link-update">
                    @elseif($slider->link_name != null && $slider->description == null && $slider->description != " "  && $slider->link == null && $slider->link != " ")
                        <a href="{{ route('products.show_id', $slider->products_slug) }}" class="link-update">
                    @else
                        <a class="link-update">
                    @endif
                        <figure class="glider-slider">
                            <img class="w-full object-cover object-center slider-img" src="{{ Storage::url($slider->image) }}" alt="">
                        </figure>
                    </a>
                @endforeach

            </div>

            <button aria-label="Previous" class="glider-prev"><i class="fas fa-chevron-left"></i></button>
            <button aria-label="Next" class="glider-next"><i class="fas fa-chevron-right"></i></button>
            <div role="tablist" class="dots"></div>
        </div>
    @else

        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>

    @endif
</div>
