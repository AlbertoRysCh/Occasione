<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;


use Illuminate\Support\Facades\Storage;

use App\Models\Config; 
use App\Models\Location; 

use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CreateConfig extends Component
{

    use WithFileUploads;

    public $locations, $configs, $rand, $config;

    public $editImage;

    protected $listeners = ['delete'];
 
    
    public $createForm = [
        
        'name' => null, 
        'cr' => null,
        'location' => null, 
        'correo' => null,
        'telefono' => null,
        'url_whats' => null,
        'url_telg' => null,
        'url_instagram' => null,
        'url_tiktok' => null,
        'url_facebook' => null,
        'color_texto_menu' => null,
        'color_fondo_menu' => null,
        'location_id' => null,
        'status' => null, 
        'image' => null, 
    ];


    public $editForm = [
        'open' => false,
        'name' => null, 
        'cr' => null,
        'location' => null, 
        'correo' => null,
        'telefono' => null,
        'url_whats' => null,
        'url_telg' => null,
        'url_instagram' => null,
        'url_tiktok' => null,
        'url_facebook' => null,
        'color_texto_menu' => null,
        'color_fondo_menu' => null,
        'location_id' => null,
        'status' => null, 
        'image' => null, 
    ];
 

    protected $rules = [
        'createForm.name' =>  'required',
        'createForm.cr' => 'required',
        'createForm.location' =>  'required',
        'createForm.correo' => 'required',
        'createForm.telefono' => 'required',
        'createForm.url_whats' => '',
        'createForm.url_telg' => '',
        'createForm.url_instagram' => '',
        'createForm.url_tiktok' => '',
        'createForm.url_facebook' => '',
        'createForm.color_texto_menu' => 'required',
        'createForm.color_fondo_menu' => 'required',
        'createForm.location_id' => 'required',
        'createForm.status' =>  'required',
        'createForm.image' =>  'required',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name' ,
        'createForm.cr' =>'cr',
        'createForm.location' =>'location' ,
        'createForm.correo' =>'correo',
        'createForm.telefono' =>'telefono' ,
        'createForm.color_texto_menu' =>'color_texto_menu',
        'createForm.color_fondo_menu' =>'color_fondo_menu',
        'createForm.location_id' =>'location_id',
        'createForm.status' =>'status' ,
        'createForm.image' =>'image' , 
        'editForm.name' => 'name' ,
        'editForm.cr' =>'cr',
        'editForm.location' =>'location' ,
        'editForm.correo' =>'correo',
        'editForm.telefono' =>'telefono' ,
        'editForm.color_texto_menu' =>'color_texto_menu',
        'editForm.color_fondo_menu' =>'color_fondo_menu',
        'editForm.location_id' =>'location_id',
        'editForm.status' =>'status' ,
        'editImage' =>'image'
       
    ];

    public function mount(){
        $this->getConfig();
        $this->getLocation();
        $this->rand = rand();
    } 

    public function getConfig(){
        $this->configs = Config::all()->first();
    }
 
    public function getLocation(){
        $this->locations = Location::all();
    }
 

    public function save(){
        $this->validate(); 

        
        $imageName = $this->createForm['name'].'.'.$this->createForm['image']->extension();  
        $uploadedFileUrl = $this->createForm['image']->storeAs('storage/logos',$imageName,'public_uploads');
        $uploadedFileUrl = 'logos/'.$imageName;

        $location = Config::create([
            'nombre_empresa' => $this->createForm['name' ],
            'cr' => $this->createForm['cr'],
            'ubicacion' => $this->createForm['location' ],
            'correo' => $this->createForm['correo'],
            'telefono' => $this->createForm['telefono'],
            'link_whatsapp' => $this->createForm['url_whats'],
            'link_telegram' => $this->createForm['url_telg'],
            'instagram' => $this->createForm['url_instagram'],
            'tiktok' => $this->createForm['url_tiktok'],
            'facebook' => $this->createForm['url_facebook'],
            'color_texto_menu' => $this->createForm['color_texto_menu'],
            'color_fondo_menu' => $this->createForm['color_fondo_menu'],
            'location_id' => $this->createForm['location_id'],
            'status' => $this->createForm['status' ],
            'logo' => $uploadedFileUrl  
        ]);
   
        $this->rand = rand();
        $this->reset('createForm');

        $this->getLocation();
        $this->emit('saved');
    }

    public function edit(Location $location){

        $this->reset(['editImage']);
        $this->resetValidation();

        $this->location = $this->getLocation();

        $this->editForm['open'] = true;
        $this->editForm['name'] = $location->name;
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
 

            $imageName =  $this->editForm['heading'].'.'.$this->editImage->extension();  
            $uploadedFileUrl = $this->editImage->storeAs('storage/paises',$imageName,'public_uploads');
            $uploadedFileUrl = 'paises/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl;
        }


        $rules = [
            'editForm.name' => 'required', 
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
        return view('livewire.admin.create-config');
    }
}
