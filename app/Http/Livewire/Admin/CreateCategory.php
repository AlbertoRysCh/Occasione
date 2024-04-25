<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;

use Livewire\Component;

use Illuminate\Support\Str;

use Livewire\WithFileUploads;

class CreateCategory extends Component
{

    use WithFileUploads;

    public $brands, $categories, $category, $rand, $rand2;

    protected $listeners = ['delete'];

    public $createForm = [

        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'image_banner' => null,
        'brands' => [],
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'image_banner' => null,
        'brands' => [],
    ];

    public $editImage;

    public $editImage2;

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:categories,slug',
        'createForm.icon' => 'required',
        'createForm.image' => 'required|image|max:3072',
        'createForm.image_banner' => 'required|image|max:3072',
        'createForm.brands' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.icon' => 'ícono',
        'createForm.image' => 'imagen',
        'createForm.image_banner' => 'imagen_banner',
        'createForm.brands' => 'marcas',
        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',
        'editForm.icon' => 'ícono',
        'editImage' => 'imagen',
        'editImage2' => 'image_banner',
        'editForm.brands' => 'marcas'
    ];

    public function mount()
    {
        $this->getBrands();
        $this->getCategories();
        $this->rand = rand();
        $this->rand2 = rand();
    }

    public function updatedCreateFormName($value)
    {
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value)
    {
        $this->editForm['slug'] = Str::slug($value);
    }

    public function getBrands()
    {
        $this->brands = Brand::all();
    }

    public function getCategories()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate();
        // dd($this->createForm['brands']);
        // $image = $this->createForm['image']->store('public/categories');
        $imageName =  $this->createForm['slug'] . '.' . $this->createForm['image']->extension();
        $image = $this->createForm['image']->storeAs('storage/categories', $imageName, 'public_uploads');
        $image = 'categories/' . $imageName;

        $imageName_banner =  $this->createForm['slug'] . '_banner.' . $this->createForm['image_banner']->extension();
        $image_banner = $this->createForm['image_banner']->storeAs('storage/subcategories', $imageName_banner, 'public_uploads');
        $image_banner = 'subcategories/' . $imageName_banner;

        $category = Category::create([
            'name' => $this->createForm['name'],
            'slug' => $this->createForm['slug'],
            'icon' => $this->createForm['icon'],
            'image' => $image,
            'image_banner' => $image_banner
        ]);

        $category->brands()->attach($this->createForm['brands']);

        $this->rand = rand();
        $this->rand2 = rand();
        $this->reset('createForm');

        $this->getCategories();
        $this->emit('saved');
    }

    public function edit(Category $category)
    {

        $this->reset(['editImage']);
        $this->reset(['editImage2']);
        $this->resetValidation();

        $this->category = $category;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $category->name;
        $this->editForm['slug'] = $category->slug;
        $this->editForm['icon'] = $category->icon;
        $this->editForm['image'] = $category->image;
        $this->editForm['image_banner'] = $category->image_banner;
        $this->editForm['brands'] = $category->brands->pluck('id');
        // dd($this->editForm['brands']);
    }

    public function update()
    {

        $rules = [
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:categories,slug,' . $this->category->id,
            'editForm.icon' => 'required',
            'editForm.brands' => 'required',
        ];

        if ($this->editImage) {
            $rules['editImage'] = 'required|image|max:3072';
        }
        if ($this->editImage2) {
            $rules['editImage2'] = 'required|image|max:3072';
        }

        $this->validate($rules);

        if ($this->editImage) {
            Storage::delete($this->editForm['image']);

            $imageName =  $this->editForm['slug'] . '.' . $this->editImage->extension();
            $image = $this->editImage->storeAs('storage/categories', $imageName, 'public_uploads');
            $image = 'categories/' . $imageName;

            // $this->editForm['image'] = $this->editImage->store('categories');
            $this->editForm['image'] = $image;
        }

        if ($this->editImage2) {
            Storage::delete($this->editForm['image_banner']);

            $imageName_banner =  $this->editForm['slug'] . '_banner.' . $this->editImage2->extension();
            $image_banner = $this->editImage2->storeAs('storage/subcategories', $imageName_banner, 'public_uploads');
            $image_banner = 'subcategories/' . $imageName_banner;

            // $this->editForm['image'] = $this->editImage2->store('categories');
            $this->editForm['image_banner'] = $image_banner;
        }


        $this->category->update($this->editForm);

        $this->category->brands()->sync($this->editForm['brands']);

        $this->reset(['editForm', 'editImage']);

        $this->getCategories();
    }

    public function delete(Category $category)
    {
        $category->delete();
        $this->getCategories();
    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
