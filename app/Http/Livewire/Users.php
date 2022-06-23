<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    
    public $user_id;
    public $first_name, $last_name, $username, $email, $address1, $city, $state, $postal_code, $phone, $gender, $dob;
    public $isModalOpen = 0;
    public $modelTitle;

    protected $rules = [
        'first_name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'username' => 'required|min:3|unique:users',
        'password' => 'required|min:3',
        'email' => 'required|min:3|email|unique:users',
        'address1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'postal_code' => 'required|digits:5',
        'phone' => 'required|digits:10',
        'gender' => 'required',
        'dob' => 'required|date_format:m/d/Y'
    ]; 

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->resetErrorBag();

        $this->modelTitle = 'Add New User';
        $this->openModalPopover();
    }

    public function store()
    {
        if($this->user_id) {
            $this->rules['username'] = $this->rules['username'].',id,'.$this->user_id;
            $this->rules['email'] = $this->rules['email'].',id,'.$this->user_id;
        }

        $this->validate();

        $user = User::updateOrCreate(['id' => $this->user_id], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);

        $user->detail()->updateOrCreate(['user_id' => $user->id], [
            'address1' => $this->address1,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'dob' => $this->dob
        ]);

        session()->flash('message', 
        $this->user_id ? 'User Updated Successfully.' : 'User Created Successfully.');

        $this->closeModalPopover();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $this->resetErrorBag();

        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;

        $this->address1 = $user->detail->address1;
        $this->city = $user->detail->city;
        $this->state = $user->detail->state;
        $this->postal_code = $user->detail->postal_code;
        $this->phone = $user->detail->phone;
        $this->gender = $user->detail->gender;
        $this->dob = $user->detail->dob;

        $this->modelTitle = 'Update User';
        $this->openModalPopover();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $user->detail()->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetInputFields(){
        $this->user_id = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->username = '';
        $this->password = '';
        $this->email = '';
        $this->address1= '';
        $this->city = '';
        $this->state = '';
        $this->postal_code = '';
        $this->phone = '';
        $this->gender = '';
        $this->dob = '';
    }
}
