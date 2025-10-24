<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MeQuery
{
    public function __invoke(): ?User
    {
        return Auth::guard('api')->user();
    }
}
