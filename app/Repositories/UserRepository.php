<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class UserRepository
{
    public function create(array $data)
    {
        User::create($data);
    }

    public function all()
    {
        return User::all();
    }

    public function update(array $data, $id)
    {   
        $id = Crypt::decrypt($id);
        User::find($id)->update($data);
    }

    public function destroy($id)
    {  
        $id = Crypt::decrypt($id);
        User::find($id)->delete();
    }

    public function lock($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $user->lock = !$user->lock;
        $user->save();
    }

    public function operator()
    {
        return User::where('role', 'operator')->get();
    }
}