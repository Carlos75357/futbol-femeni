<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equip extends Model
{
    /**
 * @OA\Schema(
 *     schema="Equip",
 *     description="Esquema de Equip",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         readOnly=true,
 *     ),
 *     @OA\Property(
 *         property="nom",
 *         type="string",     
 *     ),
 *     @OA\Property(
 *         property="estadi_id",
 *         type="integer",     
 *     ),
 *     @OA\Property(
 *         property="titols",
 *         type="integer",     
 *     ),
 *     @OA\Property(
 *         property="escut",
 *         type="string",     
 *     ),
 * )
 */
    use HasFactory;
    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function jugadors()
    {
        return $this->hasMany(Jugador::class);
    }

    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'equip_local_id');
    }

    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'equip_visitant_id');
    }

    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'equip_local_id');
    }

    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'equip_visitant_id');
    }

    public function partits()
    {
        return $this->hasMany(Partit::class, 'equip_local_id')
                    ->orWhere('equip_visitant_id', $this->id);
    }

    public function getEdadMediaAttribute()
    {
        $jugadores = $this->jugadors->toArray();

        if (count($jugadores) === 0) {
            return 0;
        }
        $edadTotal = array_sum(array_map(function ($jugador) {
            return (int) \Carbon\Carbon::parse($jugador['data_naixement'])->age;
        }, $jugadores));

        return $edadTotal / count($jugadores);
    }
}
