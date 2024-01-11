<?php

namespace App\Models;

use Spatie\Permission\Models\Role as BaseRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends BaseRole
{
    use HasFactory;
}
