<?php

namespace App\Http\Livewire\Admin\MainCategory;

use App\Models\MainCategory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    // public  $photo;
    public $nameArBeforeUpdate;
    public $nameEnBeforeUpdate;
    public $name;
    public $photo;
    public $status;
    public $translation_lang;
    public $translation_of;
    public $categoryId;
    public $categoryIdToDelete;
    public $lang;
    public $updateCategory;
    public $addCategory;
    public $search;


    protected $rules = [
        'name' => 'required',
        'photo' => 'nullable|image|max:1024|mimes:jpg,png,jpeg', // Adjust the maximum file size if needed
        'status' => 'boolean',

    ];
    protected $casts = [
        'name' => 'array',
    ];
    public function resetFields()
    {
        $this->name = '';
        $this->photo = '';
        // $this->translation_lang = '';
        $this->status = false;
        // $this->translation_of = '';
        $this->categoryIdToDelete = null;
    }
    public function render()
    {
        $query = MainCategory::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $data = $query->get();

        return view('livewire.admin.main-category.index', compact('data'))
            ->extends('admin.dashbord')
            ->section('content');
    }
    public function addCategory()
    {
        $this->resetFields();
        $this->addCategory = true;
        $this->updateCategory = false;
    }
    public function store()
    {
        $validatedData = $this->validate();


        if ($validatedData) {
            // Handle file upload if a photo is selected
            if ($this->photo) {
                $photoPath = $this->photo->store('admin/category/photos', 'public');
            }
            // Create the category using the validated data
            $category = MainCategory::create([
                'name' => json_encode($this->name),
                'status' => $this->status ?? false,
                // Optionally, handle the photo upload
                'photo' => $this->photo ? $photoPath : null,
            ]);

            // dd($category);



            session()->flash('success', 'Created Successfully !!');
            $this->resetFields();
            $this->addCategory = false;
        } else {
            session()->flash('error', 'Something goes wrong !!');
        }
    }

    public function delete()
    {
        $category = MainCategory::find($this->categoryIdToDelete);

        // Remove the associated photo if it exists
        if ($category->photo) {
            Storage::disk('public')->delete($category->photo);
        }

        $category->delete();

        session()->flash('success', "The Category Deleted Successfully!!");
        $this->resetFields();
    }
    public function edit($id)
    {
        $this->updateCategory = true;
        $this->addCategory = false;
        $category = MainCategory::find($id);
        if ($category) {
            $name = json_decode($category->name, true);
            $this->photo = $category->photo;
            $this->status = $category->status;
            $this->nameArBeforeUpdate = $name['ar'];
            $this->nameEnBeforeUpdate = $name['en'];
            $this->categoryId = $id;
        }
    }




    public function update()
    {
        $validatedData = $this->validate();
        dd($validatedData);
        if ($validatedData) {
            $category = MainCategory::findOrFail($this->categoryId);

            $category->name = $this->name;
            $category->status = $this->status;

            if ($this->photo) {
                if ($category->photo) {
                    Storage::disk('public')->delete($category->photo);
                }

                $photoPath = $this->photo->store('admin/category/photos', 'public');
                $category->photo = $photoPath;
            }

            $category->save();

            $this->resetFields();
            $this->updateCategory = false;

            session()->flash('success', 'MainCategory Updated Successfully!');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function cancel()
    {
        $this->addCategory = false;
        $this->updateCategory = false;
        $this->resetFields();
    }
}