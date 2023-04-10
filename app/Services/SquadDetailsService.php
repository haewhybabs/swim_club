<?php
namespace App\Services;

use App\Repositories\SquadDetailsRepository;

class SquadDetailsService
{
    protected $squadDetailsRepository;

    public function __construct(SquadDetailsRepository $squadDetailsRepository)
    {
        $this->squadDetailsRepository = $squadDetailsRepository;
    }

    public function findById($id){
        return $this->squadDetailsRepository->findById($id);
    }

    public function findBySwimmerId($swimmerId){
        return $this->squadDetailsRepository->findBySwimmerId($swimmerId);
    }

    public function findBySquadId($squadId){
        return $this->squadDetailsRepository->findBySquadId($squadId);
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->squadDetailsRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->squadDetailsRepository->update($attributes,$id);
    }

    public function delete($id)
    {
        // Add business logic here, if necessary
        return $this->squadDetailsRepository->delete($id);
    }
}
?>