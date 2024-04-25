<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Twilio\Rest\Client; 

class WhatsappOrder extends Component
{
    public function render()
    {
        return view('livewire.whatsapp-order');
    }
 
 
    public function save(){
        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        $sid =config('services.twilio.sid');
        $token = config('services.twilio.token');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
                        ->create("whatsapp:+51943271725", // to
                                [
                                    "from" => "whatsapp:+51998357484",
                                    "body" => "Hello there!"
                                ]
                        );

        dd($message->sid);
    }

}
