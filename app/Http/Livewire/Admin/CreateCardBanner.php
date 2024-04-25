<?php

namespace App\Http\Livewire\Admin;


use Illuminate\Support\Facades\Storage;

use App\Models\CardBanner;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CreateCardBanner extends Component
{//deleteCardbanner
   
    
    use WithFileUploads;
    public $envio_type = 1;
    public $s_envio_type = 1;
    public $envio_type_up = 1;
    public $s_envio_type_up = 1;

    public $categories,$products,$card_banners, $rand, $s_rand, $id_cardbanner;

    protected $listeners = ['delete'];

    public $view = "grid";

    public $editImage;
    public $s_editImage;

    public $s_tipo_card;

    public $createForm = [
        
        'tipo_card' => null,

        'heading' => null,
        'description' => null,
        'link' => null,
        'link_name' => null,
        'image' => null,

        's_heading' => null,
        's_description' => null,
        's_link' => null,
        's_link_name' => null,
        's_image' => null,

        'status' =>  false,
    ];
    
    public $editForm = [
        'open' => false,
        
        'tipo_card' => null,

        'heading' => null,
        'description' => null,
        'link' => null,
        'link_name' => null,
        'image' => null,
        
        's_heading' => null,
        's_description' => null,
        's_link' => null,
        's_link_name' => null,
        's_image' => null,

        'status' =>  false,
    ];

    
    protected $rules = [
        'createForm.image' => 'required|image|max:2048', 
        'createForm.heading' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.tipo_card' => 'tipo_card',

        'createForm.heading' => 'heading',
        'createForm.description' => 'description',
        'createForm.link' => 'link',
        'createForm.link_name' => 'link_name',
        'createForm.image' => 'imagen',
        
        'createForm.s_heading' => 's_heading',
        'createForm.s_description' => 's_description',
        'createForm.s_link' => 's_link',
        'createForm.s_link_name' => 's_link_name',
        'createForm.s_image' => 's_imagen',

        'createForm.status' => 'status',
        
        'editForm.tipo_card' => 'tipo_card',

        'editForm.heading' => 'heading',
        'editForm.description' => 'description',
        'editForm.link' => 'link',
        'editForm.link_name' => 'link_name',
        'editImage' => 'imagen', 
        
        'editForm.s_heading' => 's_heading',
        'editForm.s_description' => 's_description',
        'editForm.s_link' => 's_link',
        'editForm.s_link_name' => 's_link_name',
        's_editImage' => 's_imagen',

        'editForm.status' => 'status'
    ];


    public function mount(){
        $this->categories = Category::all();
        $this->products = Product::all();

        $this->getCardBanners(); 
        $this->rand = rand();
        $this->s_rand = rand();
    }

    public function getCardBanners(){
        $this->card_banners = CardBanner::all();
    }

    public function save(){
        $this->validate();
  
        $imageName = $this->createForm['heading'].'-'.time().'.'.$this->createForm['image']->extension();  
        $uploadedFileUrl = $this->createForm['image']->storeAs('storage/cardbanners',$imageName,'public_uploads');
        $uploadedFileUrl = 'cardbanners/'.$imageName; 

        // $uploadedFileUrl = $this->createForm['image']->move('storage/sliders');
         
        if($this->view=="grid"){
            if($this->envio_type == '1'){
                $this->createForm['link']=null;
                $this->createForm['link_name']=null;
            }else if($this->envio_type == '2'){
                $this->createForm['description']=null;
                $this->createForm['link_name']=null;
            }else if($this->envio_type == '3'){
                $this->createForm['description']=null;
                $this->createForm['link']=null;
            }
            CardBanner::create([ 
                'tipo_card' =>  '1',
                'heading' =>  $this->createForm['heading'],
                'description' => $this->createForm['description'],
                'link' => $this->createForm['link'],
                'link_name' => $this->createForm['link_name'],
                'image' => $uploadedFileUrl,
                'status' =>   $this->createForm['status']
            ]);
        }else{
            
            $this->validate([
                'createForm.s_image' => 'required|image|max:2048',
                'createForm.s_heading' => 'required',
            ]);

            $s_imageName = $this->createForm['s_heading'].'-'.time().'.'.$this->createForm['s_image']->extension();  
            $s_uploadedFileUrl = $this->createForm['s_image']->storeAs('storage/cardbanners',$s_imageName,'public_uploads');
            $s_uploadedFileUrl = 'cardbanners/'.$s_imageName;


            if($this->envio_type == '1'){
                $this->createForm['link']=null;
                $this->createForm['link_name']=null;
            }else if($this->envio_type == '2'){
                $this->createForm['description']=null;
                $this->createForm['link_name']=null;
            }else if($this->envio_type == '3'){
                $this->createForm['description']=null;
                $this->createForm['link']=null;
            }

            if($this->s_envio_type == '1'){
                $this->createForm['s_link']=null;
                $this->createForm['s_link_name']=null;
            }else if($this->s_envio_type == '2'){
                $this->createForm['s_description']=null;
                $this->createForm['s_link_name']=null;
            }else if($this->s_envio_type == '3'){
                $this->createForm['s_description']=null;
                $this->createForm['s_link']=null;
            }
            CardBanner::create([
                    'tipo_card' =>  '0',
                    'heading' =>  $this->createForm['heading'],
                    'description' => $this->createForm['description'],
                    'link' => $this->createForm['link'],
                    'link_name' => $this->createForm['link_name'],
                    'image' => $uploadedFileUrl,
                    's_heading' =>  $this->createForm['s_heading'],
                    's_description' => $this->createForm['s_description'],
                    's_link' => $this->createForm['s_link'],
                    's_link_name' => $this->createForm['s_link_name'],
                    's_image' => $s_uploadedFileUrl,
                    'status' =>   $this->createForm['status']
            ]);
        }

        
        $this->rand = rand();
        $this->s_rand = rand();
        $this->reset('createForm');
 
        $this->getCardBanners(); 
        $this->emit('saved');
    }
    public function edit(CardBanner  $cardbanner){

        $this->reset(['editImage']);
        $this->reset(['s_editImage']);
    
        $this->resetValidation();

        $this->id_cardbanner = $cardbanner; 

        $this->editForm['open'] = true;
        $this->editForm['tipo_card'] = $cardbanner->tipo_card;
        if($cardbanner->tipo_card == '1'){
            $this->view = 'grid';
        }else{
            $this->view = 'list';
        }  

        $this->editForm['heading'] = $cardbanner->heading;

        $this->editForm['description'] = $cardbanner->description; 
        if($cardbanner->description != null){
            $this->envio_type_up = "1";
        }

        $this->editForm['link'] = $cardbanner->link; 
        if($cardbanner->link != null){
            $this->envio_type_up = "2";
        } 

        $this->editForm['link_name'] = $cardbanner->link_name; 
        if($cardbanner->link_name != null){
            $this->envio_type_up = "3";
        } 

        $this->editForm['image'] = $cardbanner->image;

        $this->editForm['status'] = $cardbanner->status;
 
        $this->editForm['s_heading'] = $cardbanner->s_heading;
         
        $this->editForm['s_description'] = $cardbanner->s_description; 
        if($cardbanner->s_description != null){
            $this->s_envio_type_up = "1";
        } 

        $this->editForm['s_link'] = $cardbanner->s_link;  
        if($cardbanner->s_link != null){
            $this->s_envio_type_up = "2";
        } 

        $this->editForm['s_link_name'] = $cardbanner->s_link_name; 
        if($cardbanner->s_link_name != null){
            $this->s_envio_type_up = "3";
        } 

        $this->editForm['s_image'] = $cardbanner->s_image;
 
    }

    public function update(){
        
        if ($this->editImage) {

            $rules['editImage'] = 'required|image|max:2048';

            // if( $this->editForm['tipo_card'] == "0" ){
            if( $this->view == "list" ){
                //solo estara disponible si se selecciona dos cards
                
                $rules['s_editImage'] = 'required|image|max:2048';
            }
        }
 

        if ($this->editImage) { 
          

            $imageName =  $this->editForm['heading'].'-'.time().'.'.$this->editImage->extension();  
            $uploadedFileUrl = $this->editImage->storeAs('storage/cardbanners',$imageName,'public_uploads');
            $uploadedFileUrl = 'cardbanners/'.$imageName;

            $this->editForm['image'] = $uploadedFileUrl;

            // if( $this->editForm['tipo_card'] == "0" ){//solo estara disponible si se selecciona dos cards
                
            if( $this->view == "list" ){//solo estara disponible si se selecciona dos cards
 
                $s_imageName =  $this->editForm['s_heading'].'-'.time().'.'.$this->s_editImage->extension();  
                $s_uploadedFileUrl = $this->s_editImage->storeAs('storage/cardbanners',$s_imageName,'public_uploads');
                $s_uploadedFileUrl = 'cardbanners/'.$s_imageName;
    
                $this->editForm['s_image'] = $s_uploadedFileUrl;
            }
        }

        if($this->envio_type_up == '1'){
            $this->editForm['link']=null;
            $this->editForm['link_name']=null;
        }else if($this->envio_type_up == '2'){
            $this->editForm['description']=null;
            $this->editForm['link_name']=null;
        }else if($this->envio_type_up == '3'){
            $this->editForm['description']=null;
            $this->editForm['link']=null;
        }

        if($this->view == 'list'){
            if($this->s_envio_type_up == '1'){
                $this->editForm['s_link']=null;
                $this->editForm['s_link_name']=null;
            }else if($this->s_envio_type_up == '2'){
                $this->editForm['s_description']=null;
                $this->editForm['s_link_name']=null;
            }else if($this->s_envio_type_up == '3'){
                $this->editForm['s_description']=null;
                $this->editForm['s_link']=null;
            }
        }

        $this->id_cardbanner->update($this->editForm);

        // $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getCardBanners();
    }

    public function delete(CardBanner $cardbanner){
        $cardbanner->delete(); 
        $this->getCardBanners(); 
    }
 
    public function render()
    {
        return view('livewire.admin.create-card-banner');
    }
}
