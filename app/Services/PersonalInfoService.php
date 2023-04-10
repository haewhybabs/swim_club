<?php
namespace App\Services;

use App\Repositories\PersonalInfoRepository;

class PersonalInfoService
{
    protected $personalInfoRepository;

    public function __construct(PersonalInfoRepository $personalInfoRepository)
    {
        $this->personalInfoRepository = $personalInfoRepository;
    }

    public function findById($id){
        return $this->personalInfoRepository->findById($id);
    }

    public function findByUserId($userId){
        return $this->personalInfoRepository->findByUserId($userId);
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->personalInfoRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->personalInfoRepository->update($attributes,$id);
    }

    public function delete($id)
    {
        // Add business logic here, if necessary
        return $this->personalInfoRepository->delete($id);
    }
}
?>