<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;

class ImageProduct extends Component
{
    
    use WithFileUploads;
    use WithPagination;

    public $product, $status, $rand, $position, $id_image;
  
    public $editImage;
    public $createForm = [                
        'image' => null,
    ];
    
    public $editForm = [
        'open' => false,
        
        'image' => null,
    ];

    protected $rules = [
        'createForm.image' => 'required|image|max:2048',
    ];

    protected $validationAttributes = [
        'createForm.image' => 'imagen',
    ];


    public function mount(){
 
        $this->rand = rand();
        // dd($this->product->id);
        $this->getPositionImagen();
        // dd($this->position);
        $this->status = $this->product->status;

    }

    public function getPositionImagen(){
        $this->position =  DB::table('images')
        ->leftJoin('products', 'products.id', '=', 'images.imageable_id') 
        ->orWhere('products.id', $this->product->id)
        ->where('images.position', 'primary')->value('images.position');
    }

    public function save(){
        // $this->product->status = $this->status;
        // $this->product->save();
        // $this->validate(); 

        $imageName =  time().'.'.$this->createForm['image']->extension();
        $uploadedFileUrl = $this->createForm['image']->storeAs('storage/products',$imageName,'public_uploads');
        $uploadedFileUrl = 'products/'.$imageName;

        $this->product->images()->create([
            'url' => $uploadedFileUrl,
            'position' => 'primary'
        ]);
  
        $this->emit('saved');
        $this->rand = rand();
        
        $this->product = $this->product->fresh();
        $this->getPositionImagen();
        // return redirect()->route('admin.products.edit', $this->product);
    }

    public function edit_primary(Image $image){

        $this->reset(['editImage']); 
    
        $this->resetValidation();

        $this->id_image = $image; 

        $this->editForm['open'] = true;
         
        $this->editForm['image'] = $image->url; 
    }

    public function update(){
        
        if ($this->editImage) { 
            $rules['editImage'] = 'required|image|max:2048'; 
       
            Storage::delete([$this->id_image->url]);
            $this->id_image->delete();
 
            $imageName =  time().'.'.$this->editImage->extension();  
            $uploadedFileUrl = $this->editImage->storeAs('storage/products',$imageName,'public_uploads');
            $uploadedFileUrl = 'products/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl; 
 
        }
 
        $this->product->images()->create([
            'url' => $this->editForm['image'],
            'position' => 'primary'
        ]);
          
        // $this->id_image->update($this->editForm);
        
        $this->getPositionImagen();
        $this->reset(['editForm', 'editImage']);
        $this->product = $this->product->fresh();
        // return redirect()->route('admin.products.edit', $this->product);
        // $this->emit('refreshProduct'); 
        // $this->resetPage();

    }


    public function render()
    {
        return view('livewire.admin.image-product');
    }
}
