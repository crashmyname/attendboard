<?php
namespace App\Services;

use App\Models\User;
use Bpjs\Framework\Helpers\Hash;
use Bpjs\Framework\Helpers\Validator;

class UserService
{
    public function Count()
    {
        return User::query()->count();
    }
}
