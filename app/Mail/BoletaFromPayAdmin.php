<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BoletaFromPayAdmin extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $email;
    protected $order;
    protected $item_p;
    protected $envio;
    protected $menssage;
    protected $order_id;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $order_id, $order, $item_p, $envio, $menssage)
    {
        //
        $this->name = $name;
        $this->email = $email;
        $this->order = $order;
        $this->item_p = $item_p;
        $this->envio = $envio;
        $this->menssage = $menssage;
        $this->order_id = $order_id;
        // dd($item_p);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // return $this->view('emails.BoletaFromPay');
        return $this->from($this->email)->subject("Nuevo pedido Occasione")->view('emails.BoletaFromPayAdmin')->with([
            'name' => $this->name,
            'email' => $this->email,
            'order' => $this->order,
            'item_p' => $this->item_p,
            'envio' => $this->envio,
            'usermessage' => $this->menssage,
        ]);
    }
}
