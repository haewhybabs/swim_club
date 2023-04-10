<?php
namespace App\Repositories;

use App\Models\SquadDetails;

class SquadDetailsRepository
{
    public function findAll()
    {
        return SquadDetails::all();
    }
    public function findById($id)
    {
        return SquadDetails::find($id);
    }

    public function findBySwimmerId($swimmerId)
    {
        return SquadDetails::where('swimmer_id',$swimmerId)->first();
    }
    public function findBySquadId($squadId)
    {
        return SquadDetails::where('squad_id',$squadId)->get();
    }
    public function create(array $data)
    {
        return SquadDetails::create($data);
    }

    public function update(array $data, $id)
    {
        $SquadDetails = SquadDetails::findOrFail($id);
        $SquadDetails->update($data);
        return $SquadDetails;
    }

    public function delete($id)
    {
        $SquadDetails = SquadDetails::findOrFail($id);
        $SquadDetails->delete();
        return true;
    }
}
?>