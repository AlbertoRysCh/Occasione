@props(['category'])


@if(count($category->subcategories) == 1)
<div class="grid grid-cols-2 p-4" style="display: flex;justify-content: center">
    <div class="hidden"> 
@else
<div class="grid grid-cols-4 p-4"> 
    <div> 
@endif
        @foreach ($category->subcategories as $subcategory)
            @if(count($category->subcategories  ) != 1)
                <p class="text-lg font-bold text-center text-trueGray-500 mb-3">Subcategorías</p>
            @endif
            @break
        @endforeach
        <ul>
            @foreach ($category->subcategories as $subcategory) 
                @if(count($category->subcategories) == 1)
                    @break
                @else
                    <li>
                        <a href="{{route('categories.show', $category) . '?subcategoria=' . $subcategory->slug}}" 
                            class="text-trueGray-500 inline-block font-semibold py-1 px-4 hover:text-orange-500">
                            {{$subcategory->name}}
                        </a>
                    </li> 
                @endif

            @endforeach
        </ul>
    </div>

    <div class="col-span-3">

        <img class="h-64 w-full object-cover object-center" style="width: 40rem !important;height:100%" src="{{Storage::url($category->image)}}" alt="">

    </div>

</div>