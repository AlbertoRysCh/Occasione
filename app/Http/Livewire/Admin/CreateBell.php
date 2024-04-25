<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Storage;

use App\Models\Bell; 
use Livewire\Component;

use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CreateBell extends Component
{

    use WithFileUploads;

    public $bells, $rand, $id_bell;

    protected $listeners = ['delete'];

    public $editImage;

    public $createForm = [
        
        'name' => null,
        'image' => null,
        'status' =>  false,
    ];
    
    public $editForm = [
        'open' => false,
        'name' => null,
        'image' => null,
        'status' =>  false,
    ];

    
    protected $rules = [
        'createForm.image' => 'image|max:2048',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name',
        'createForm.image' => 'imagen',
        'createForm.status' => 'status',
        'editForm.name' => 'name',
        'editImage' => 'imagen',
        'editForm.status' => 'status'
    ];


    public function mount(){
        
        $this->getBells(); 
        $this->rand = rand();
    }

    public function getBells(){
        $this->bells = Bell::all();
    }

    public function save(){
        if ($this->editImage) {
            $rules['editImage'] = 'image|max:1024';
        }
        if ($this->editImage) { 
            $imageName = $this->createForm['name'].'_bell_'.time().'.'.$this->createForm['image']->extension();  
            $uploadedFileUrl = $this->createForm['image']->storeAs('storage/bells',$imageName,'public_uploads');
            $uploadedFileUrl = 'bells/'.$imageName;
        }else{
            $uploadedFileUrl = null;
        }
 
        Bell::create([
            'name' =>  $this->createForm['name'],
            'image' => $uploadedFileUrl,
            'status' =>   $this->createForm['status']
        ]);
  
        $this->rand = rand();
        $this->reset('createForm');
 
        $this->getBells(); 
        $this->emit('saved');
    }
    public function edit(Bell $bell){

        $this->reset(['editImage']);
        $this->resetValidation();

        $this->id_bell = $bell; 

        $this->editForm['open'] = true;
        $this->editForm['name'] = $bell->name;
        $this->editForm['image'] = $bell->image;
        $this->editForm['status'] = $bell->status;
    }

    public function update(){
          
        if ($this->editImage) {
            $rules['editImage'] = 'image|max:1024';
        }
 

        if ($this->editImage) {
            $imageName =  $this->editForm['name'].'_bell_'.time().'.'.$this->editImage->extension();  
            $uploadedFileUrl = $this->editImage->storeAs('storage/bells',$imageName,'public_uploads');
            $uploadedFileUrl = 'bells/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl;
        }
 

        $this->id_bell->update($this->editForm);

        $this->reset(['editForm', 'editImage']);

        $this->getBells();
    }

    public function delete(Bell $bell){
        $bell->delete(); 
        $this->getBells(); 
    }



    public function render()
    {
        return view('livewire.admin.create-bell');
    } 
}

