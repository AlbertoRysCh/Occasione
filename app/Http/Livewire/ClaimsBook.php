<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ClainsBook;

use App\Mail\ClainsBookAdminMail;
use App\Mail\ClaimsBookMail;
use Illuminate\Support\Facades\Mail;

class ClaimsBook extends Component
{
    public $name, $last_name, $phone, $other_phone, $type_direction, $direction, $address_lote, $address_departament, $address_urbanization, $address_line2, $address_region, $address_municipality, $address_city, $type_document, $claim_document, $email, $product_amount, $product_description, $num_pedido, $type_reclam, $detalle, $pedido ;

    public $ticket,$n_reclamo;

    public $createForm = [ 
        'name' => null,
        'last_name' => null,
        'phone' => null,
        'other_phone' => null,
        'type_direction' => null,
        'direction' => null,
        'address_lote' => null,
        'address_departament' => null,
        'address_urbanization' => null,
        'address_line2' => null,
        'address_region' => null,
        'address_municipality' => null,
        'address_city' => null,
        'type_document' => null,
        'claim_document' => null,
        'email' => null,
        'product_amount' => null,
        'product_description' => null,
        'num_pedido' => null,
        'type_reclam' => null,
        'detalle' => null,
    ];
 

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.last_name' => 'required',
        'createForm.phone' => 'required',
        'createForm.other_phone' => ' ',
        'createForm.type_direction' => 'required',
        'createForm.direction' => 'required',
        'createForm.address_lote' => 'required',
        'createForm.address_departament' => ' ',
        'createForm.address_urbanization' => ' ',
        'createForm.address_line2' => ' ',
        'createForm.address_region' => 'required',
        'createForm.address_municipality' => 'required',
        'createForm.address_city' => 'required',
        'createForm.type_document' => 'required',
        'createForm.claim_document' => 'required',
        'createForm.email' => 'required',
        'createForm.product_amount' => 'required',
        'createForm.product_description' => 'required',
        'createForm.num_pedido' => ' ',
        'createForm.type_reclam' => 'required',
        'createForm.detalle' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.name' =>'name',
        'createForm.last_name' =>'last_name',
        'createForm.phone' =>'phone',
        'createForm.other_phone' =>'other_phone',
        'createForm.type_direction' =>'type_direction',
        'createForm.direction' =>'direction',
        'createForm.address_lote' =>'address_lote',
        'createForm.address_departament' =>'address_departament',
        'createForm.address_urbanization' =>'address_urbanization',
        'createForm.address_line2' =>'address_line2',
        'createForm.address_region' =>'address_region',
        'createForm.address_municipality' =>'address_municipality',
        'createForm.address_city' =>'address_city',
        'createForm.type_document' =>'type_document',
        'createForm.claim_document' =>'claim_document',
        'createForm.email' =>'email',
        'createForm.product_amount' =>'product_amount',
        'createForm.product_description' =>'product_description',
        'createForm.num_pedido' =>'num_pedido',
        'createForm.type_reclam' =>'type_reclam',
        'createForm.detalle' =>'detalle'
       
    ];

    public function send_mail(){
        $rules = $this->rules;
 
        $this->validate($rules);
        
        $permitted_chars = '0123456789';
        
        $date_time = date('hdiy', time());  
        
        $this->ticket = "L".$date_time.substr(str_shuffle($permitted_chars), 0, 4);
        $this->n_reclamo = substr(str_shuffle($permitted_chars), 0, 6)."-".date('Y', time());
        
        //CREATE
        $clains = new ClainsBook();
        $clains->ticket = $this->ticket;
        $clains->n_reclamo = $this->n_reclamo;
        $clains->name = $this->createForm['name'];
        $clains->last_name = $this->createForm['last_name'];
        $clains->phone = $this->createForm['phone'];
        $clains->other_phone = $this->createForm['other_phone'];
        $clains->type_direction = $this->createForm['type_direction'];
        $clains->direction = $this->createForm['direction'];
        $clains->address_lote = $this->createForm['address_lote'];
        $clains->address_departament = $this->createForm['address_departament'];
        $clains->address_urbanization = $this->createForm['address_urbanization'];
        $clains->address_line2 = $this->createForm['address_line2'];
        $clains->address_region = $this->createForm['address_region'];
        $clains->address_municipality = $this->createForm['address_municipality'];
        $clains->address_city = $this->createForm['address_city'];
        $clains->type_document = $this->createForm['type_document'];
        $clains->claim_document = $this->createForm['claim_document'];
        $clains->email = $this->createForm['email'];
        $clains->product_amount = $this->createForm['product_amount'];
        $clains->product_description = $this->createForm['product_description'];
        $clains->num_pedido = $this->createForm['num_pedido'];
        $clains->type_reclam = $this->createForm['type_reclam'];
        $clains->detalle = $this->createForm['detalle'];
        $clains->pedido = "vacio";
        $clains->status = false;

        $clains->save();

        //ADMIN
        Mail::to(env('MAIL_FROM_ADM'))->send(new ClainsBookAdminMail($this->ticket, $this->n_reclamo,
        $this->createForm['name'], 
        $this->createForm['last_name'],
        $this->createForm['phone'],
        $this->createForm['other_phone'],
        $this->createForm['type_direction'],
        $this->createForm['direction'],
        $this->createForm['address_lote'],
        $this->createForm['address_departament'],
        $this->createForm['address_urbanization'],
        $this->createForm['address_line2'],
        $this->createForm['address_region'],
        $this->createForm['address_municipality'],
        $this->createForm['address_city'],
        $this->createForm['type_document'],
        $this->createForm['claim_document'],
        $this->createForm['email'],
        $this->createForm['product_amount'],
        $this->createForm['product_description'],
        $this->createForm['num_pedido'],
        $this->createForm['type_reclam'],
        $this->createForm['detalle'],
        null,
        'Libro de reclamaciones'));
        //USER
        Mail::to($this->createForm['email'])->send(new ClaimsBookMail($this->ticket, $this->n_reclamo, 
        $this->createForm['name'], 
        $this->createForm['last_name'],
        $this->createForm['phone'],
        $this->createForm['other_phone'],
        $this->createForm['type_direction'],
        $this->createForm['direction'],
        $this->createForm['address_lote'],
        $this->createForm['address_departament'],
        $this->createForm['address_urbanization'],
        $this->createForm['address_line2'],
        $this->createForm['address_region'],
        $this->createForm['address_municipality'],
        $this->createForm['address_city'],
        $this->createForm['type_document'],
        $this->createForm['claim_document'],
        $this->createForm['email'],
        $this->createForm['product_amount'],
        $this->createForm['product_description'],
        $this->createForm['num_pedido'],
        $this->createForm['type_reclam'],
        $this->createForm['detalle'],
        null,
        'Libro de reclamaciones'));

        
        $this->reset('createForm');
        $this->emit('clains_book_ok');
    }
    public function render()
    {
        // dd(auth()->user()->email);
        return view('livewire.claims-book');
    }
    
}
