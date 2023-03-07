<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findAll()
    {
        return User::all();
    }
    public function findById($id)
    {
        return User::find($id);
    }
    public function findByEmail($email){
        return User::where('email',$email)->first();
    }
    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $User = User::findOrFail($id);
        $User->update($data);
        return $User;
    }

    public function delete($id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        return true;
    }
}
?>