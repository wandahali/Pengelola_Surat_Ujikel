<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letter_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_type',
        'letter_code',
    ];

    public function letters()
    {
        return $this->hasMany(Letter::class, 'letter_type_id', 'id');
    }
}   
