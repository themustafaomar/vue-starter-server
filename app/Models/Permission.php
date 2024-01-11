<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as BasePermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends BasePermission
{
    use HasFactory;

    // /**
    //  * The attributes that aren't mass assignable.
    //  *
    //  * @var array<string>|bool
    //  */
    // protected $guarded = ['*'];

    // protected $fillable = ['name', 'guard_name'];
}
