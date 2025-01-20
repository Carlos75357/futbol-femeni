<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estadi extends Model
{
    /**
 * @OA\Schema(
 *     schema="Estadi",
 *     description="Esquema de Estadi",
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
 *         property="ciutat",
 *         type="string",     
 *     ),
 *     @OA\Property(
 *         property="capacitat",
 *         type="integer",     
 *     ),
 * )
 */
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
