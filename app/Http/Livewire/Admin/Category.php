<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class Category extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;
    public $description;
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    public $status = 0;
    public $popular = 0;
    public $updateMode = false;
    public $addMode = false;
    public $showModal = false;
    public $categoryIdToDelete = null;
    public $categoryIdToUpdate = null;
    public $search = '';
    public $statusFilter = '';
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'status' => 'required|boolean',
        'popular' => 'required|boolean',
        'image' => 'nullable|image|max:1024', // Max file size is 1MB
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->image = '';
        $this->description = '';
        $this->meta_title = '';
        $this->meta_keywords = '';
        $this->meta_description = '';
        $this->status = '';
        $this->popular = '';
    }




    public function render()
    {
        // $this->resetFields();

        $categories = ModelsCategory::query();

        // apply search filter
        if ($this->search !== '') {
            $categories->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        // apply status filter
        if ($this->statusFilter !== '') {
            $categories->where('status', $this->statusFilter);
        }

        $data = $categories->paginate(10);
        return view('livewire.admin.category', ['data' => $data])->extends('layouts.index')->section('content');
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($validatedData) {


            if (isset($this->image)) {
                $path = $this->image->store('category/images');
                $imageName = basename($path);
            }
            // dd('saddad');
            ModelsCategory::create([
                'name' => $this->name,
                'image' =>  $imageName,
                'slug' =>   Str::slug($this->name),
                'description' => $this->description,
                'meta_title' => $this->meta_title,
                'meta_keywords' => $this->meta_keywords,
                'meta_description' => $this->meta_description,
                'status' => $this->status,
                'popular' => $this->popular,
            ]);
            if (Storage::exists("category/images/{$imageName}")) {

                $imagePath = base_path('storage/app/category/images/' . $imageName);
                if (file_exists($imagePath)) {
                    $image = Image::make($imagePath);
                    $image->resize(150, 150)->save();
                    session()->flash('success', 'Category Created Successfully!!');
                    $this->resetFields();
                } else {
                    // File does not exist
                    session()->flash('error', 'Image file not found.');
                }
            } else {
                session()->flash('error', 'Something goes wrong!!');
            }

            // $this->addCategory = false;
        } else {
            session()->flash('error', 'Something goes wrong!!');
        }
        // <!-- $this->showModal = false; -->

        $this->emit('categoryform');        // return redirect()->route('category.index');
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $category = ModelsCategory::findOrFail($id); // Use findOrFail to return a 404 error if the ID is not found
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
        $this->description = $category->description;
        $this->meta_title = $category->meta_title;
        $this->meta_keywords = $category->meta_keywords;
        $this->meta_description = $category->meta_description;
        $this->status = $category->status;
        $this->popular = $category->popular;

        // return redirect()->route('admin.createCategory', ['category' => $category]);
    }
    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'popular' => 'required|boolean',
            'image' => 'nullable|image|max:1024', // Max file size is 1MB
        ]);

        // Find the category by its ID
        $category = ModelsCategory::findOrFail($this->categoryIdToUpdate);

        // // Update the category information
        // $category->name = $this->name;
        // $category->description = $this->description;
        // $category->meta_title = $this->meta_title;
        // $category->meta_keywords = $this->meta_keywords;
        // $category->meta_description = $this->meta_description;
        // $category->status = $this->status;
        // $category->popular = $this->popular;

        if (isset($this->image)) {
            // Remove the old image from storage
            Storage::delete("category/images/{$category->image}");

            // Store the new image and update the image name in the database
            $path = $this->image->store('category/images');
            $imageName = basename($path);
            $category->image = $imageName;

            // Resize the image
            $imagePath = base_path('storage/app/category/images/' . $imageName);
            if (file_exists($imagePath)) {
                $image = Image::make($imagePath);
                $image->resize(150, 150)->save();
            }
        }

        $category->update([
            'name' => $this->name,
            'image' =>  $imageName,
            'slug' =>   Str::slug($this->name),
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
            'popular' => $this->popular,
        ]);

        // Save the updated category
        // $category->save();


        $this->resetFields();
        $this->render();
        session()->flash('success', 'Category updated successfully!');
    }

    public function deleteCategory()
    {
        // Find the category by its ID
        $category = ModelsCategory::findOrFail($this->categoryIdToDelete);
        if ($category) {
            // Remove the corresponding image from storage
            Storage::delete("category/images/{$category->image}");

            // Remove the corresponding category from the database
            $category->delete();

            session()->flash('success', 'Category deleted successfully!');
        } else {
            session()->flash('error', 'Unable to find the category!');
        }

        $this->showModal = false;
    }
    public function cancel()
    {
        // $this->updateMode = false;
        // $this->resetInputFields();
        $this->resetFields();
        $this->dispatchBrowserEvent('closeModal');         // $this->emit('modalClosed');
    }



    function copyCategories()
    {
        // Get all the categories
        $categories = ModelsCategory::all();

        // Copy the category names to the clipboard
        $names = $categories->pluck('name')->implode("\n");
        \Illuminate\Support\Facades\Artisan::call('clipboard:copy', ['value' => $names]);

        // Return a success message
        return "Copied all categories to the clipboard:\n\n$names";
    }

    public function printCategories()
    {
        // Get all the categories
        $categories = ModelsCategory::all();

        // Generate an HTML table of the categories
        $html = '<table>';
        foreach ($categories as $category) {
            $html .= '<tr>';
            $html .= '<td>' . $category->name . '</td>';
            $html .= '<td>' . $category->description . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        // Halt execution and launch the Livewire debug console
        $this->debug();

        // Return the HTML table for debugging purposes
        return $html;
    }
    function exportCategoriesToExcel()
    {
        // Get all the categories
        $categories = ModelsCategory::all();

        // Define the Excel export file name
        $fileName = 'categories.xlsx';

        // Generate the Excel file using Laravel Excel
        Excel::create($fileName, function ($excel) use ($categories) {
            $excel->sheet('Categories', function ($sheet) use ($categories) {
                // Add the category names and descriptions to the sheet
                $data = [];
                foreach ($categories as $category) {
                    $data[] = [$category->name, $category->description];
                }
                $sheet->fromArray($data);
            });
        })->download();

        // Return a success message
        return "Exported all categories to Excel:\n\n" . $categories->pluck('name')->implode("\n");
    }
    function exportCategoriesToPDF()
    {
        // Get all the categories
        $categories = ModelsCategory::all();

        // Define the PDF export file name
        // $fileName = 'categories.pdf';

        // Clear the output buffer
        ob_clean();

        // Generate the PDF file using Dompdf and prompt the user to download it
        $pdf = PDF::loadView('pdf.categories', ['categories' => $categories]);
        return $pdf->download('categories.pdf');
    }
}
