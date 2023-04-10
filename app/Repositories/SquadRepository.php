<?php
namespace App\Repositories;

use App\Models\Squad;

class SquadRepository
{
    public function findAll()
    {
        return Squad::all();
    }
    public function findById($id)
    {
        return Squad::find($id);
    }

    public function findByCoachId($coachId)
    {
        return Squad::where('coach_id',$coachId)->first();
    }
    public function create(array $data)
    {
        return Squad::create($data);
    }

    public function update(array $data, $id)
    {
        $Squad = Squad::findOrFail($id);
        $Squad->update($data);
        return $Squad;
    }

    public function delete($id)
    {
        $Squad = Squad::findOrFail($id);
        $Squad->delete();
        return true;
    }
}
?>