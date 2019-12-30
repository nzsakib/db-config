<?php

namespace Nzsakib\DbConfig\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('db-config.table_name');
    }

    protected $fillable = ['name', 'value'];

    protected $casts = [
        'value' => 'array',
    ];
}
