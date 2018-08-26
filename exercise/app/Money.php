<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'status',
    ];

    const UPDATED_AT = null;
}
