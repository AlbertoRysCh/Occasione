<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;


use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search;
    public $status;
    protected $queryString = ['status'];

    public function limpiar()
    {
        $this->reset(['status', 'page']);
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        //hola mundo

        $productsQuery = Product::where('name', 'like', '%' . $this->search . '%');

        if ($this->status) {

            $productsQuery = $productsQuery->where('status', $this->status);
        }


        $products = $productsQuery->paginate(50);

        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');
    }
}
