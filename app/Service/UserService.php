<?php

namespace App\Service;

use App\Models\Scopes\UserScope;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private UserScope $user)
    {
        //
    }

    /**
     * @return array
     */
    public function getAllRegisterTimer(): array
    {
        $arr = [];
        return $arr;
    }
}
