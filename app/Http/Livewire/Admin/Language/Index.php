<?php

namespace App\Http\Livewire\Admin\Language;

use App\Models\Language;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $abbr;
    public $locale;
    public $active = true;
    public $dir = 'rtl';
    public $langId;
    public $updateLang;
    public $addLang;

    // protected $listeners = [
    //     'deleteLangListner' => 'deletePost'
    // ];


    protected $rules = [
        'name' => 'required|string|max:100',
        'abbr' => 'required|string|max:10',
        //  'active' => 'required|in:1',
        'dir' => 'required|in:rtl,ltr'
    ];

    public function resetFields()
    {
        $this->name = '';
        $this->abbr = '';
        $this->locale = '';
        $this->active = false;
        $this->dir = 'rtl';
    }
    public function render()
    {
        $data = Language::all();
        return view('livewire.admin.language.index', compact('data'))->extends('admin.dashbord')->section('content');
    }

    public function addLang()
    {
        $this->resetFields();
        $this->addLang = true;
        $this->updateLang= false;
    }
    public function store()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            Language::create(
                [
                    'name' => $this->name,
                    'abbr' => $this->abbr,
                    'locale' => $this->locale,
                    'active' => $this->active,
                    'dir' => $this->dir,
                ]
            );
            session()->flash('success', 'Created Successfully !!');
            $this->resetFields();
            $this->addLang = false;
        } else {
            session()->flash('error', 'Something goes wrong !!');
        }
    }

    public function delete($id)
    {
        Language::find($id)->delete();
        session()->flash('success', "The Language Deleted Successfully!!");
    }

    public function edit($id)
    {
        $lang = Language::findOrFail($id);
        if (isset($lang)) {

            $this->name = $lang->name;
            $this->abbr = $lang->abbr;
            $this->locale = $lang->locale;
            $this->active = $lang->active;
            $this->dir = $lang->dir;
            $this->langId = $lang->langId;
            $this->updateLang = true;
            $this->addLang = false;
        }
    }


    public function update()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            Language::whereId($this->langId)->update([
                'name' => $this->name,
                'abbr' => $this->abbr,
                'locale' => $this->locale,
                'active' => $this->active,
                'dir' => $this->dir,
            ]);
            $this->resetFields();
            $this->updateLang = false;
            session()->flash('success', 'Language Updated Successfully!!');

       } else {
            session()->flash('error', 'Something goes wrong !!');
        }
    }
    public function cancel()
    {
        $this->addLang = false;
        $this->updateLang = false;
        $this->resetFields();
    }
}