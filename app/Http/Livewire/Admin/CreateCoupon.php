<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;

use Livewire\Component;

class CreateCoupon extends Component
{
    public $code;
    public $discount;
    public $start_date;
    public $end_date;
    public $usage_limit;
    protected $coupons; 
   
    public $couponId;
 

    protected $rules = [
        'code' => 'required|unique:coupons,code|max:255',
        'discount' => 'required|numeric|max:99',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'usage_limit' => 'required|integer|min:1',
    ];

    public function save()
    {
        $this->validate();

        Coupon::create([
            'code' => $this->code,
            'discount' => $this->discount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'usage_limit' => $this->usage_limit,
        ]);

        // Reset form fields
        $this->reset(['code', 'discount', 'start_date', 'end_date', 'usage_limit']);

        // Optionally, you can add a flash message or other notification here
        session()->flash('message', 'Cupón creado exitosamente.');
    }
    public function deleteCoupon($id)
    {
        Coupon::destroy($id);
        // Actualizar la lista de cupones después de la eliminación, si es necesario
        $this->coupons = Coupon::paginate(); // O cualquier otro método para obtener los cupones actualizados
    }

    /*public function editCoupon($id)
    {
    $coupon = Coupon::findOrFail($id);
    $this->couponId = $coupon->id;
    $this->code = $coupon->code;
    $this->discount = $coupon->discount;
    $this->start_date = $coupon->start_date;
    $this->end_date = $coupon->end_date;
    $this->usage_limit = $coupon->usage_limit;

    $this->dispatchBrowserEvent('showEditModal');
}

public function updateCoupon()
{
    $this->validate();

    $coupon = Coupon::findOrFail($this->couponId);
    $coupon->update([
        'code' => $this->code,
        'discount' => $this->discount,
        'start_date' => $this->start_date,
        'end_date' => $this->end_date,
        'usage_limit' => $this->usage_limit,
    ]);

    // Reset form fields and close modal
    $this->reset(['couponId', 'code', 'discount', 'start_date', 'end_date', 'usage_limit']);
    $this->dispatchBrowserEvent('closeEditModal');
}

*/
    public function render()
    {
        $coupons = Coupon::paginate();
        return view('livewire.admin.create-coupon', compact('coupons'))->layout('layouts.admin');
    }
}
