<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Storage;

use App\Models\Subbanner;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class CreateSubbaner extends Component
{
    use WithFileUploads;

    public $categories,$products,$subbanners, $rand, $id_subbanner;

    protected $listeners = ['delete'];

    public $editImage;

    public $createForm = [
        
        'heading' => null,
        'description' => null,
        'link' => null,
        'link_name' => null,
        'image' => null,
        'status' =>  false,
    ];
    
    public $editForm = [
        'open' => false,
        'heading' => null,
        'description' => null,
        'link' => null,
        'link_name' => null,
        'image' => null,
        'status' =>  false,
    ];

    
    protected $rules = [
        'createForm.image' => 'required|image|max:2048',
    ];

    protected $validationAttributes = [
        'createForm.heading' => 'heading',
        'createForm.description' => 'description',
        'createForm.link' => 'link',
        'createForm.link_name' => 'link_name',
        'createForm.image' => 'imagen',
        'createForm.status' => 'status',
        'editForm.heading' => 'heading',
        'editForm.description' => 'description',
        'editForm.link' => 'link',
        'editForm.link_name' => 'link_name',
        'editImage' => 'imagen',
        'editForm.status' => 'status'
    ];


    public function mount(){
        $this->categories = Category::all();
        $this->products = Product::all();

        $this->getSubbanners(); 
        $this->rand = rand();
    }

    public function getSubbanners(){
        $this->subbanners = Subbanner::all();
    }

    public function save(){
        $this->validate();

        // $uploadedFileUrl = Cloudinary::upload($this->createForm['image']->getRealPath(),
        // [
        //     'folder' => 'slider',
        //     'transformation' => [
        //         'width' => 1403,
        //         'height' => 325
        //     ]
        // ])->getSecurePath();
 
        $imageName = $this->createForm['heading'].'-'.time().'.'.$this->createForm['image']->extension();  
        $uploadedFileUrl = $this->createForm['image']->storeAs('storage/subbaners',$imageName,'public_uploads');
        $uploadedFileUrl = 'subbaners/'.$imageName;

        
        // $uploadedFileUrl = $this->createForm['image']->move('storage/sliders');
         

         Subbanner::create([
            'heading' =>  $this->createForm['heading'],
            'description' => $this->createForm['description'],
            'link' => $this->createForm['link'],
            'link_name' => $this->createForm['link_name'],
            'image' => $uploadedFileUrl,
            'status' =>   $this->createForm['status']
        ]);
  
        $this->rand = rand();
        $this->reset('createForm');
 
        $this->getSubbanners(); 
        $this->emit('saved');
    }
    public function edit(Subbanner $subbanner){

        $this->reset(['editImage']);
        $this->resetValidation();

        $this->id_subbanner = $subbanner; 

        $this->editForm['open'] = true;
        $this->editForm['heading'] = $subbanner->heading;
        $this->editForm['description'] = $subbanner->description; 
        $this->editForm['link'] = $subbanner->link;  
        $this->editForm['link_name'] = $subbanner->link_name; 
        $this->editForm['image'] = $subbanner->image;
        $this->editForm['status'] = $subbanner->status;
    }

    public function update(){
        
        if ($this->editImage) {
            $rules['editImage'] = 'required|image|max:1024';
        }
 

        if ($this->editImage) {

            // $uploadedFileUrl = Cloudinary::upload($this->editImage->getRealPath(),
            // [
            //     'folder' => 'slider',
            //     'transformation' => [
            //       'width' => 1403,
            //       'height' => 325
            //     ]
            // ])->getSecurePath();
 

            $imageName =  $this->editForm['heading'].'-'.time().'.'.$this->editImage->extension();  
            $uploadedFileUrl = $this->editImage->storeAs('storage/subbanners',$imageName,'public_uploads');
            $uploadedFileUrl = 'subbanners/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl;
        }
 

        $this->id_subbanner->update($this->editForm);

        // $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getSubbanners();
    }

    public function delete(Subbanner $subbanner){
        $subbanner->delete(); 
        $this->getSubbanners(); 
    }


    public function render()
    {
        return view('livewire.admin.create-subbaner');
    }
     
}
