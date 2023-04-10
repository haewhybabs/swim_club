<?php
namespace App\Services;

use App\Repositories\SquadRepository;

class SquadService
{
    protected $squadRepository;

    public function __construct(SquadRepository $squadRepository)
    {
        $this->squadRepository = $squadRepository;
    }
    
    public function findAll(){
        return $this->squadRepository->findAll();
    }

    public function findById($id){
        return $this->squadRepository->findById($id);
    }

    public function findByCoachId($coachId){
        return $this->squadRepository->findByCoachId($coachId);
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->squadRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->squadRepository->update($attributes,$id);
    }

    public function delete($id)
    {
        // Add business logic here, if necessary
        return $this->squadRepository->delete($id);
    }
}
?>