<?php
namespace App\Repositories;

use App\Models\Swimmer;

class SwimmerRepository
{
    public function findAll()
    {
        return Swimmer::all();
    }
    public function findById($id)
    {
        return Swimmer::find($id);
    }

    public function findByUserId($userId)
    {
        return Swimmer::where('user_id',$userId)->first();
    }
    public function create(array $data)
    {
        return Swimmer::create($data);
    }

    public function update(array $data, $id)
    {
        $swimmer = Swimmer::findOrFail($id);
        $swimmer->update($data);
        return $swimmer;
    }

    public function updateParentId($parentId, $id)
    {
        $swimmer = Swimmer::findOrFail($id);
        $swimmer->parent_id = $parentId;
        $swimmer->update();
        return $swimmer;
    }

    public function delete($id)
    {
        $swimmer = Swimmer::findOrFail($id);
        $swimmer->delete();
        return true;
    }

    public function findSwimmersWithoutParent(){
        
        return Swimmer::whereDoesntHave('parent')->get();
    }
}
?>