<?php
namespace App\Repositories;

use App\Models\GalaEvent;

class GalaEventRepository
{
    public function findAll()
    {
        return GalaEvent::all();
    }
    public function findById($id)
    {
        return GalaEvent::find($id);
    }

    public function findByGender($gender)
    {
        return GalaEvent::where('gender',$gender)->get();
    }

    public function findByRaceType($raceType)
    {
        return GalaEvent::where('raceType',$raceType)->get();
    }

    public function findByDistanceId($distanceId)
    {
        return GalaEvent::where('distance_id',$distanceId)->get();
    }

    public function findByStrokeId($strokeId)
    {
        return GalaEvent::where('distance_id',$strokeId)->get();
    }
    public function create(array $data)
    {
        return GalaEvent::create($data);
    }

    public function update(array $data, $id)
    {
        $race = GalaEvent::findOrFail($id);
        $race->update($data);
        return $race;
    }

    public function delete($id)
    {
        $race = GalaEvent::findOrFail($id);
        $race->delete();
        return true;
    }
}
?>