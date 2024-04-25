<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Storage;

use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CreateSlider extends Component
{

    use WithFileUploads;

    public $categories,$products,$sliders, $rand, $id_slider;

    protected $listeners = ['delete'];

    public $editImage;
    public $link_type = 1;
    public $up_link_type = 1;

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
        'createForm.image' => 'required|image|max:4096',
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

        $this->getSliders(); 
        $this->rand = rand();
    }

    public function getSliders(){
        $this->sliders = Slider::all();
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
        $uploadedFileUrl = $this->createForm['image']->storeAs('storage/sliders',$imageName,'public_uploads');
        $uploadedFileUrl = 'sliders/'.$imageName;

        
        // $uploadedFileUrl = $this->createForm['image']->move('storage/sliders');
         

        if($this->link_type == '1'){
            $this->createForm['link']=null;
            $this->createForm['link_name']=null;
        }else if($this->link_type == '2'){
            $this->createForm['description']=null;
            $this->createForm['link_name']=null;
        }else if($this->link_type == '3'){
            $this->createForm['description']=null;
            $this->createForm['link']=null;
        }

         Slider::create([
            'heading' =>  $this->createForm['heading'],
            'description' => $this->createForm['description'],
            'link' => $this->createForm['link'],
            'link_name' => $this->createForm['link_name'],
            'image' => $uploadedFileUrl,
            'status' =>   $this->createForm['status']
        ]);
  
        $this->rand = rand();
        $this->reset('createForm');
 
        $this->getSliders(); 
        $this->emit('saved');
    }
    public function edit(Slider $slider){

        $this->reset(['editImage']);
        $this->resetValidation();

        $this->id_slider = $slider; 

        $this->editForm['open'] = true;
        $this->editForm['heading'] = $slider->heading;

        if($slider->description != null){
            $this->up_link_type = "1";
        }
 
        if($slider->link != null){
            $this->up_link_type = "2";
        } 
 
        if($slider->link_name != null){
            $this->up_link_type = "3";
        } 
        
        $this->editForm['description'] = $slider->description; 
        $this->editForm['link'] = $slider->link;  
        $this->editForm['link_name'] = $slider->link_name; 

        $this->editForm['image'] = $slider->image;
        $this->editForm['status'] = $slider->status;
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
            $uploadedFileUrl = $this->editImage->storeAs('storage/sliders',$imageName,'public_uploads');
            $uploadedFileUrl = 'sliders/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl;
        }
 
        if($this->up_link_type == '1'){
            $this->editForm['link']=null;
            $this->editForm['link_name']=null;
        }else if($this->up_link_type == '2'){
            $this->editForm['description']=null;
            $this->editForm['link_name']=null;
        }else if($this->up_link_type == '3'){
            $this->editForm['description']=null;
            $this->editForm['link']=null;
        }

        $this->id_slider->update($this->editForm);

        // $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getSliders();
    }

    public function delete(Slider $slider){
        $slider->delete(); 
        $this->getSliders(); 
    }


    public function render()
    {
        return view('livewire.admin.create-slider');
    }
}

