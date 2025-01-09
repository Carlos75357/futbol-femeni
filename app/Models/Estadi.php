<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estadi extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'capacitat'];

    public function equips()
    {
        return $this->hasMany(Equip::class);
    }

    public function partits()
    {
        return $this->hasMany(Partit::class);
    }
}
