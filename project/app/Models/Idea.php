<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }
}
