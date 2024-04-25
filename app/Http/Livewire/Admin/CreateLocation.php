<?php

namespace App\Http\Livewire\Admin;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLocation extends Component
{ 

    use WithFileUploads;

    public $locations, $rand, $location;

    public $editImage;

    protected $listeners = ['delete'];

    public $createForm = [
        
        'name' => null, 
        'url_dom' => null,
        'money' => null,
        'status' => null, 
        'image' => null, 
    ];


    public $editForm = [
        'open' => false,
        'name' => null, 
        'money' => null,
        'url_dom' => null,
        'status' => null, 
        'image' => null,
    ];
 

    protected $rules = [
        'createForm.name' => 'required', 
        'createForm.money' => 'required', 
        'createForm.url_dom' => 'required', 
        'createForm.status' => 'required',
        'createForm.image' => 'required',  
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name',
        'createForm.money' => 'money',
        'createForm.url_dom' => 'url_dom',
        'createForm.status' => 'status', 
        'createForm.image' => 'imagen',
        'editForm.name' => 'name',
        'editForm.money' => 'money',
        'editForm.url_dom' => 'url_dom',
        'editImage' => 'imagen',
        'editForm.status' => 'status'
    ];

    public function mount(){
        $this->getLocation();  
        $this->rand = rand();
    } 

    public function getLocation(){
        $this->locations = Location::all();
    }
 

    public function save(){
        $this->validate(); 

        
        $imageName = $this->createForm['name'].'.'.$this->createForm['image']->extension();  
        $uploadedFileUrl = $this->createForm['image']->storeAs('storage/paises',$imageName,'public_uploads');
        $uploadedFileUrl = 'paises/'.$imageName;

        $location = Location::create([
            'name' => $this->createForm['name'],
            'money' => $this->createForm['money'],
            'url_dom' => $this->createForm['url_dom'],
            'status' => $this->createForm['status'],
            'img' => $uploadedFileUrl
        ]);
   
        $this->rand = rand();
        $this->reset('createForm');

        $this->getLocation();
        $this->emit('saved');
    }

    public function edit(Location $location){

        $this->reset(['editImage']);
        $this->resetValidation();

        $this->location = $location;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $location->name;
        $this->editForm['money'] = $location->money;
        $this->editForm['url_dom'] = $location->url_dom;
        $this->editForm['status'] = $location->status; 
        $this->editForm['image'] = $location->image;
        
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
 

            $imageName =  $this->editForm['name'].'.'.$this->editImage->extension();  
            $uploadedFileUrl = $this->editImage->storeAs('storage/paises',$imageName,'public_uploads');
            $uploadedFileUrl = 'paises/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl;
        }


        $rules = [
            'editForm.name' => 'required', 
            'editForm.money' => 'required',
            'editForm.url_dom' => 'required',
            'editForm.status' => 'required',
        ];

        
        $this->validate($rules);
 
        $this->location->update($this->editForm); 

        $this->reset(['editForm', 'editImage']);

        $this->getLocation();
    }

    public function delete(Location $location){
        $location->delete();
        $this->getLocation();
    }

    public function render()
    {
        return view('livewire.admin.create-location');
    }
}
