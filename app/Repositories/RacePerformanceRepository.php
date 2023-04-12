<?php
namespace App\Repositories;

use App\Models\RacePerformance;

class RacePerformanceRepository
{
    public function findAll()
    {
        return RacePerformance::all();
    }
    public function findById($id)
    {
        return RacePerformance::find($id);
    }

    public function findBySwimmerId($swimmerId)
    {
        return RacePerformance::where('swimmer_id',$swimmerId)->first();
    }
    public function create(array $data)
    {
        return RacePerformance::create($data);
    }

    public function update(array $data, $id)
    {
        $race = RacePerformance::findOrFail($id);
        $race->update($data);
        return $race;
    }

    public function delete($id)
    {
        $race = RacePerformance::findOrFail($id);
        $race->delete();
        return true;
    }
}
?>