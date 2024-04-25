@props(['status' => '1'])
 

    <div class="bg-white rounded-lg shadow-lg px-12 py-16 mb-6 flex items-center">

        <div class="relative">
            <div class="{{ ($status >= 1 ) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>
    
            <div class="absolute -left-1.5 mt-0.5">
                <p>checkout</p>
            </div>
        </div>
    
        <div class="{{ ($status >= 2 ) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>
    
        <div class="relative">
            <div class="{{ ($status >= 2) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-shopping-cart text-white"></i>
            </div>
    
            <div class="absolute text-center -left-1 mt-0.5">
                <p>order payment</p>
            </div>
        </div>
    
    
    </div>
 