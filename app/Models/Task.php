<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('userTasks', function (Builder $builder)
        {
            $user = Auth::user();
            if ($user) {
                $builder->where('user_id', $user->id);
            }
        });
    }
}
