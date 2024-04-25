<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimsBookMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $menssage; 

    protected $ticket;
    protected $n_reclamo;
    protected $name;
    protected $last_name;
    protected $phone;
    protected $other_phone;
    protected $type_direction;
    protected $direction;
    protected $address_lote;
    protected $address_departament;
    protected $address_urbanization;
    protected $address_line2;
    protected $address_region;
    protected $address_municipality;
    protected $address_city;
    protected $type_document;
    protected $claim_document;
    protected $email;
    protected $product_amount;
    protected $product_description;
    protected $num_pedido;
    protected $type_reclam;
    protected $detalle;
    protected $pedido;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $n_reclamo, $name, $last_name, $phone, $other_phone, $type_direction, $direction, $address_lote, $address_departament, $address_urbanization, $address_line2, $address_region, $address_municipality, $address_city, $type_document, $claim_document, $email, $product_amount, $product_description, $num_pedido, $type_reclam, $detalle, $pedido ,$menssage)
    {
        //
        $this->ticket = $ticket;
        $this->n_reclamo = $n_reclamo;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->other_phone = $other_phone;
        $this->type_direction = $type_direction;
        $this->direction = $direction;
        $this->address_lote = $address_lote;
        $this->address_departament = $address_departament;
        $this->address_urbanization = $address_urbanization;
        $this->address_line2 = $address_line2;
        $this->address_region = $address_region;
        $this->address_municipality = $address_municipality;
        $this->address_city = $address_city;
        $this->type_document = $type_document;
        $this->claim_document = $claim_document;
        $this->email = $email;
        $this->product_amount = $product_amount;
        $this->product_description = $product_description;
        $this->num_pedido = $num_pedido;
        $this->type_reclam = $type_reclam;
        $this->detalle = $detalle;
        $this->pedido = $pedido;
        $this->menssage = $menssage; 
    }
 

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.ClaimsBookMail');
        return $this->from($this->email)->subject("Ticket No. ". $this->ticket ." para tu solicitud")->view('emails.ClaimsBookMail')->with([
            'n_reclamo' => $this->n_reclamo,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'other_phone' => $this->other_phone,
            'type_direction' => $this->type_direction,
            'direction' => $this->direction,
            'address_lote' => $this->address_lote,
            'address_departament' => $this->address_departament,
            'address_urbanization' => $this->address_urbanization,
            'address_line2' => $this->address_line2,
            'address_region' => $this->address_region,
            'address_municipality' => $this->address_municipality,
            'address_city' => $this->address_city,
            'type_document' => $this->type_document,
            'claim_document' => $this->claim_document,
            'email' => $this->email,
            'product_amount' => $this->product_amount,
            'product_description' => $this->product_description,
            'num_pedido' => $this->num_pedido,
            'type_reclam' => $this->type_reclam,
            'detalle' => $this->detalle,
            'pedido' => $this->pedido,
            'usermessage' => $this->menssage,
        ]);
    }
}
