<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserList extends Component
{



    use WithFileUploads;
    // public  $photo;
    // public $nameArBeforeUpdate;
    // public $nameEnBeforeUpdate;
    public $name;
    public $phone;
    public $email;
    public $username;
    public $role_id;
    public $country_id;
    public $city_id;
    public $password;
    public $password_confirmation;
    public $last_seen;
    public $profile_photo_path;
    // public $countryId;

    public $userIdToDelete;
    public $updateUser;
    public $addUser;
    public $search;
    public $selectedCountry;
    public $cities = [];
    // public $city;
    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'username' => 'required',
        'role_id' => 'required',
        'country_id' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required',
        'city_id' => 'required',
        'last_seen' => 'nullable',
        'profile_photo_path' => 'nullable|mimes:jpeg,png,jpg',
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->username = '';
        $this->role_id = "";
        $this->country_id = '';
        $this->city_id = '';
        $this->last_seen = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->profile_photo_path = '';
        $this->userIdToDelete = '';
        $this->search = '';
    }
    // public function mount()
    // {
    //     // Initialize the cities variable to an empty array
    //     $this->cities = [];
    // }
    protected $listeners = ['updatedCountryId'];

    // ...

    public function updatedCountryId($value)
    {

        if (!empty($value)) {
            $this->cities = City::where('country_id', $value)->pluck('name', 'id');
        }
    }
    public function render()
    {
        return view('livewire.admin.user.user-list', [
            'data' => User::all(),
            'roles' => Role::all(),
            'countries' => Country::all(),
            // 'cities' => $this->cities,
        ])
            ->extends('admin.dashbord')
            ->section('content');
    }


    public function addUser()
    {

        $this->resetFields();
        $this->addUser = true;
        $this->updateUser = false;
    }
    public function store()
    {
        // dd($this->role_id);

        $validatedData = $this->validate();
        if ($validatedData) {
            // Handle file upload if a photo is selected
            if ($this->password !== $this->password_confirmation) {
                session()->flash('error', 'The confirmation password does not match.');
            }


            // Handle the image upload if it exists
            if ($this->profile_photo_path) {
                $this->profile_photo_path = $this->profile_photo_path->store('profiles', 'public');
            }
            // Create the product using the validated data
            $user =
                User::create([
                    'name' => $this->name,
                    'username' => $this->username,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'role_id' => $this->role_id,
                    'city_id' => $this->city_id,
                    'country_id' => $this->country_id,
                    'password' => Hash::make($this->password),
                    'profile_photo_path' => $this->profile_photo_path,
                ]);

            session()->flash('success', 'User created successfully!');
            $this->resetFields();
            $this->addUser = false;
        } else {
            session()->flash('error', 'Something went wrong!');
        }
    }

    public function delete()
    {
        $user = User::find($this->userIdToDelete);

        // Remove the associated photo if it exists
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();

        session()->flash('success', "The User Deleted Successfully!!");
        $this->resetFields();
    }


    public function cancel()
    {
        $this->addUser = false;
        $this->updateUser = false;
        $this->resetFields();
    }
}
