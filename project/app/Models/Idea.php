<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperIdea
 */
class Idea extends Model
{
    //
    protected $fillable = [
        'description',
        'state',
        'user_id',
    ];
    protected $guarded = [];
}
