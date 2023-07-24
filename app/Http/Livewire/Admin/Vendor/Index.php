<?php

namespace App\Http\Livewire\Admin\Vendor;

use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithFileUploads;

    public $name;
    public $logo;
    public $mobile;
    public $email;
    public $active;
    public $address;
    public $category_id;
    public $vendorId;
    public $vendorIdToDelete;
    public $updateVendor;
    public $addVendor;
    public $search;
    public $active_categories;


    protected $rules = [
        'name' => 'required',
        'address' => 'required',
        'email' => 'nullable',
        'mobile' => 'required',
        'category_id' => 'required',
        'logo' => 'nullable|image|max:1024|mimes:jpg,png,jpeg', // Adjust the maximum file size if needed
        'active' => 'nullable|boolean',

    ];
    public function get_categories()
    {
        $categories = MainCategory::active()->get();

        $categories = $categories->map(function ($category) {
            $categoryName = json_decode($category->name, true);
            $category->translated_name = $categoryName[app()->getLocale()] ?? $categoryName;
            return $category;
        });

        $this->active_categories = $categories;
    }


    public function render()
    {
        $query = Vendor::query();
        if ($this->search) {
            $query->where(
                'name',
                'like',
                '%' . $this->search . '%'
            );
        }

        $data = $query->get();


        return view('livewire.admin.vendor.index', [
            'data' => $data,
            'categories' => $this->get_categories(), // Pass $categories to the view
        ])->extends('admin.dashbord')->section('content');
    }
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->category_id = '';
        $this->address = '';
        $this->logo = '';
        $this->active = false;
        $this->vendorIdToDelete = null;
    }

    public function addVendor()
    {

        $this->resetFields();
        $this->addVendor = true;
        $this->updateVendor = false;
    }
    public function store()
    {
        $validatedData = $this->validate();

        dd(
            $validatedData
        );
        if ($validatedData) {
            // Handle file upload if a photo is selected
            if ($this->logo) {
                $logoPath = $this->logo->store('admin/vendor/logo', 'public');
            }

            // Create the vendor using the validated data
            $vendor = Vendor::create([
                'name' => $this->name,
                'active' => $this->active ?? false,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'address' => $this->address,
                'category_id' => $this->category_id,
                'logo' => $this->logo ? $logoPath : null,
            ]);

            session()->flash('success', 'Created Successfully !!');
            $this->resetFields();
            $this->addVendor = false;
        } else {
            session()->flash('error', 'Something went wrong !!');
        }
    }

    public function delete()
    {
        $vendor = Vendor::find($this->vendorIdToDelete);

        // Remove the associated photo if it exists
        if ($vendor->photo) {
            Storage::disk('public')->delete($vendor->logo);
        }

        $vendor->delete();

        session()->flash('success', "The Vendor Deleted Successfully!!");
        $this->resetFields();
    }
    public function edit($id)
    {
        $this->updateVendor = true;
        $this->addVendor = false;
        $vendor = Vendor::find($id);
        if ($vendor) {
            $name = json_decode($vendor->name, true);
            $this->logo = $vendor->logo;
            $this->active = $vendor->active;
            $this->name = $vendor->name;
            $this->email = $vendor->email;
            $this->address = $vendor->address;
            $this->category_id = $vendor->category_id;

        }
    }




    public function update()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $category = Vendor::findOrFail($this->categoryId);

            $category->name = $this->name;
            $category->active = $this->active;

            if ($this->photo) {
                if ($category->photo) {
                    Storage::disk('public')->delete($category->photo);
                }

                $photoPath = $this->photo->store('admin/category/photos', 'public');
                $category->photo = $photoPath;
            }

            $category->save();

            $this->resetFields();
            $this->updateVendor = false;

            session()->flash('success', 'vendor Updated Successfully!');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function cancel()
    {
        $this->addVendor = false;
        $this->updateVendor = false;
        $this->resetFields();
    }




     // public function mount()
    // {
    //     $this->initializeAddressAutocomplete();
    // }

    // private function initializeAddressAutocomplete()
    // {
    //     $id = Str::random(10); // Generate a random ID for the input element

    //     $js = <<<JS
    //         function initializeAutocomplete() {
    //             var input = document.getElementById('$id');
    //             var options = {
    //                 types: ['geocode'],
    //                 componentRestrictions: { country: 'YOUR_COUNTRY_CODE' }, // Replace YOUR_COUNTRY_CODE with the desired country code
    //             };
    //             var autocomplete = new google.maps.places.Autocomplete(input, options);

    //             autocomplete.addListener('place_changed', function() {
    //                 var place = autocomplete.getPlace();

    //                 if (!place.geometry) {
    //                     return;
    //                 }

    //                 var address = place.formatted_address;
    //                 Livewire.emit('addressSelected', address);
    //             });
    //         }

    //         google.maps.event.addDomListener(window, 'load', initializeAutocomplete);
    //     JS;

    //     $script = View::make('livewire.admin.vendor.index', ['js' => $js]);

    //     $this->dispatchBrowserEvent('scriptReady', $script);
    // }
}