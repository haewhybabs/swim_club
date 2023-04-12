<?php
namespace App\Services;

use App\Repositories\GalaEventRepository;

class GalaEventService
{
    protected $galaEventRepository;

    public function __construct(GalaEventRepository $galaEventRepository)
    {
        $this->galaEventRepository = $galaEventRepository;
    }
    
    public function findAll(){
        return $this->galaEventRepository->findAll();
    }

    public function findById($id){
        return $this->galaEventRepository->findById($id);
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->galaEventRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->galaEventRepository->update($attributes,$id);
    }

    public function delete($id)
    {
        // Add business logic here, if necessary
        return $this->galaEventRepository->delete($id);
    }
}
?>