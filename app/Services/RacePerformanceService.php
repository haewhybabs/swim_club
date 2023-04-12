<?php
namespace App\Services;

use App\Repositories\RacePerformanceRepository;

class RacePerformanceService
{
    protected $racePerformanceRepository;

    public function __construct(RacePerformanceRepository $racePerformanceRepository)
    {
        $this->racePerformanceRepository = $racePerformanceRepository;
    }
    
    public function findAll(){
        return $this->racePerformanceRepository->findAll();
    }

    public function findById($id){
        return $this->racePerformanceRepository->findById($id);
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->racePerformanceRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->racePerformanceRepository->update($attributes,$id);
    }

    public function delete($id)
    {
        // Add business logic here, if necessary
        return $this->racePerformanceRepository->delete($id);
    }
}
?>