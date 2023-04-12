<?php
namespace App\Services;

use App\Repositories\SwimmerRepository;

class SwimmerService
{
    protected $swimmerRepository;

    public function __construct(SwimmerRepository $swimmerRepository)
    {
        $this->swimmerRepository = $swimmerRepository;
    }

    public function findById($id){
        return $this->swimmerRepository->findById($id);
    }

    public function findAll(){
        return $this->swimmerRepository->findAll();
    }

    public function findByUserId($userId){
        return $this->swimmerRepository->findByUserId($userId);
    }

    public function findByParentId($parentId){
        return $this->swimmerRepository->findByParentId($parentId);
    }

    public function findBySquadId($squadId){
        return $this->swimmerRepository->findBySquadId($squadId);
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->swimmerRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->swimmerRepository->update($attributes,$id);
    }

    public function updateParentId($parentId, $id)
    {
        // Add business logic here, if necessary
        return $this->swimmerRepository->updateParentId($parentId,$id);
    }

    public function findSwimmersWithoutParent(){
        
        return $this->swimmerRepository->findSwimmersWithoutParent();
    }

    public function delete($id)
    {
        // Add business logic here, if necessary
        return $this->swimmerRepository->delete($id);
    }
}
?>