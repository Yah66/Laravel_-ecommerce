<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\MainCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class Index extends Component
{
    use WithFileUploads;
    // public  $photo;
    // public $nameArBeforeUpdate;
    // public $nameEnBeforeUpdate;
    public $name;
    public $image;
    public $status;
    public $price;
    public $qty;
    public $description;
    public $discount_price;
    public $category_id;
    public $productId;
    public $productIdToDelete;
    public $updateProduct;
    public $addProduct;
    public $search;
    public $categories;


    protected $rules = [
        'name' => 'required',
        'status' => 'required',
        'price' => 'required',
        'discount_price' => 'required',
        'category_id' => 'required',
        'qty' => 'required',
        'description' => 'nullable',
        'image' => 'nullable|image|max:1024|mimes:jpg,png,jpeg',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->image = '';
        $this->price = '';
        $this->qty = '';
        $this->status = 0;
        $this->discount_price = '';
        $this->category_id = '';
        $this->discount_price = '';
        $this->description = '';
        $this->productIdToDelete = '';
        $this->search = '';
    }

    public function mount()
    {
        $this->categories = MainCategory::active()->get();
    }
    public function render()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $data = $query->get();
        // dd($data);
        return view('livewire.admin.product.index', [
            'data' => $data,
            'categories' => $this->categories
        ])
            ->extends('admin.dashbord')
            ->section('content');
    }
    public function addProduct()
    {
    
        $this->resetFields();
        $this->addProduct = true;
        $this->updateProduct = false;
    }
    public function store()
    {
        $validatedData = $this->validate();

        if ($validatedData) {
            // Handle file upload if a photo is selected
            if ($this->image) {
                $imagePath = $this->image->store('admin/products/photos', 'public');
            }

            // Create the product using the validated data
            $product = Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'category_id' => $this->category_id,
                'discount_price' => $this->discount_price,
                'description' => $this->description,
                'qty' => $this->qty,
                'status' => $this->status ?? false,
                'image' => $this->image ? $imagePath : null,
            ]);

            session()->flash('success', 'Product created successfully!');
            $this->resetFields();
            $this->addProduct = false;
        } else {
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function delete()
    {
        $product = Product::find($this->productIdToDelete);

        // Remove the associated photo if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        session()->flash('success', "The Product Deleted Successfully!!");
        $this->resetFields();
    }
    public function edit($id)
    {
        $this->updateProduct = true;
        $this->addProduct = false;
        $product = Product::find($id);
        if ($product) {
            $this->name = $product->name;
            $this->price = $product->price;
            $this->discount_price = $product->discount_price;
            $this->qty = $product->qty;
            $this->category_id = $product->category_id;
            $this->image = $product->image;
            $this->description = $product->description;
            $this->status = $product->status;
        }
    }




    public function update()
    {
        $validatedData = $this->validate();
        // dd($validatedData);

        if ($validatedData) {
            $product = Product::findOrFail($this->productId);


            if ($this->image) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                $imagePath = $this->photo->store('admin/products/photos', 'public');
                $product->photo = $imagePath;
            }

            // Create the product using the validated data
            $product->update([
                'name' => $product->name,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'discount_price' => $product->discount_price,
                'description' => $product->description,
                'qty' => $product->qty,
                'status' => $product->status ?? false,
                'image' => $product->image ? $imagePath : null,
            ]);

            $this->resetFields();
            $this->updateProduct = false;

            session()->flash('success', 'Product Updated Successfully!');
        } else {
            session()->flash('error', 'Something went wrong!');
        }
    }


    public function cancel()
    {
        $this->addProduct = false;
        $this->updateProduct = false;
        $this->resetFields();
    }

    function copyCategories()
    {
        // Get all the categories
        $categories = Product::all();

        // Copy the category names to the clipboard
        $names = $categories->pluck('name')->implode("\n");
        \Illuminate\Support\Facades\Artisan::call('clipboard:copy', ['value' => $names]);

        // Return a success message
        return "Copied all categories to the clipboard:\n\n$names";
    }

    public function printCategories()
    {
        // Get all the categories
        $categories = Product::all();

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
        $categories = Product::all();

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
        $categories = Product::all();

        // Define the PDF export file name
        // $fileName = 'categories.pdf';

        // Clear the output buffer
        ob_clean();

        // Generate the PDF file using Dompdf and prompt the user to download it
        $pdf = PDF::loadView('pdf.categories', ['categories' => $categories]);
        return $pdf->download('categories.pdf');
    }
}