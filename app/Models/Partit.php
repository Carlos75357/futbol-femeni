<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PartitActualizat;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'equip_local_id',
        'equip_visitant_id',
        'data_partit',
        'gols_local',
        'gols_visitant',
        'resultat',
    ];

    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'equip_local_id');
    }

    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'equip_visitant_id');
    }

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function arbitre()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted() {
        static::updated(function () {
            event(new PartitActualizat());
        });
    }

    public function __toString()
    {
        return $this->equipLocal->nom . " vs " . $this->equipVisitant->nom . " (" . $this->gols_local . "-" . $this->gols_visitant . ")";
    }
}

