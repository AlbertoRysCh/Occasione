<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use Livewire\WithFileUploads;
class ImportProduct extends Component
{
    
    use WithFileUploads;

    public $createForm = [ 
        'doc' => null, 
    ];
    
    protected $rules = [
        'createForm.doc' => 'required|file|mimes:xls,xlsx,csv',
    ];

    protected $validationAttributes = [
        'createForm.doc' => 'doc'
    ];

    public function save(){ 
        $this->validate([
            'createForm.doc' => 'required|file|mimes:xls,xlsx,csv',
        ]);
    
        //   $content = utf8_encode(file_get_contents($path));
        //   echo str_getcsv($content);
        // $lines = file($path);
        // $utf8_lines = array_map('utf8_encode',$lines);
        // $array = array_map('str_getcsv',$utf8_lines);

        dd($this->createForm['doc']);
    }
    public function render()
    {
        return view('livewire.admin.import-product')->layout('layouts.admin');
    }
}
