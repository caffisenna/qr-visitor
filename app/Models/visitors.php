<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visitors extends Model
{
    public $table = 'visitors';

    public $fillable = [
        'booth_number',
        'uuid'
    ];

    protected $casts = [
        'id' => 'integer',
        'booth_number' => 'string',
        'uuid' => 'string',
    ];

    public static array $rules = [
        'booth_number' => 'required'
    ];


}
