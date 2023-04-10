<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->userRepository->create($attributes);
    }

    public function updateUser(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->userRepository->update($attributes,$id);
    }

    public function deleteUser($id)
    {
        // Add business logic here, if necessary
        return $this->userRepository->delete($id);
    }

    public function findByEmail($email){
        return $this->userRepository->findByEmail($email);
    }
    public function findAllParents(){
        return $this->userRepository->findAllParents();
    }
    public function findAllCoaches(){
        return $this->userRepository->findAllCoaches();
    }
}
?>