<?php

namespace App\Services\Review;

use App\Contracts\Review\UserContract;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;

class UserService
{
	protected $userRepository;

	/**
     * ProfileService constructor
     */
    public function __construct(UserContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUserById($id)
    {
        return $this->userRepository->findUserById($id);
    }

    public function findUserBy($where)
    {
        return $this->userRepository->findUserBy($where);
    }

    public function findOneUserByOrFail($where)
    {
        return $this->userRepository->findOneUserByOrFail($where);
    }
}
