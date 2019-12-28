<?php

namespace Nzsakib\DbConfig\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['name', 'value', 'concat'];

    protected $casts = [
        'value' => 'array',
    ];
}
