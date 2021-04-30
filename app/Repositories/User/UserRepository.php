<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;
use App\Models\User;

class UserRepository implements IUserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllSupportAgents()
    {
        return $this->user->where('role', 'user')->get();
    }

}
