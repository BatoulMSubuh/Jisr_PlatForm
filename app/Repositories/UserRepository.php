<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function findByEmailOrFail(string $email): User
{
  return User::where('email', $email)->firstOrFail();
  }

 public function listUsers()
  {
    return User::all();
  }
  
}