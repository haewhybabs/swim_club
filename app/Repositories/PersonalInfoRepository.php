<?php
namespace App\Repositories;

use App\Models\PersonalInfo;

class PersonalInfoRepository
{
    public function findAll()
    {
        return PersonalInfo::all();
    }
    public function findById($id)
    {
        return PersonalInfo::find($id);
    }

    public function findByUserId($userId)
    {
        return PersonalInfo::where('user_id',$userId)->first();
    }
    public function create(array $data)
    {
        return PersonalInfo::create($data);
    }

    public function update(array $data, $id)
    {
        $User = PersonalInfo::findOrFail($id);
        $User->update($data);
        return $User;
    }

    public function delete($id)
    {
        $User = PersonalInfo::findOrFail($id);
        $User->delete();
        return true;
    }
}
?>