<x-app-layout>

    @push('style')
    <style>
         
        @media (max-width: 1200px){ 
        }
        @media (max-width: 1000px){            
        }
        @media (max-width: 800px){
            .resizer{
               height: 290px;
           }
        }
        @media (max-width: 600px){
           .resizer{
               height: 160px;
           }
        }
        @media (max-width: 400px){            
        } 
 

    </style> 
    @endpush

    <div class="container py-2 px-2 container-slider-cardv">
        <div class="resizer">
            <figure class="mb-4 h-full">
                <img class="w-full md:h-80 sm:h-full object-cover object-center imageb" src="{{ Storage::url($category->image_banner) }}" alt="">
            </figure>
        </div>
        
        @livewire('category-filter', ['category' => $category])

    </div>

</x-app-layout>
