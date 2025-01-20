<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    /**
 * @OA\Schema(
 *     schema="Jugador",
 *     description="Esquema de Jugadora",
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
 *         property="equip_id",
 *         type="integer",     
 *     ),
 *     @OA\Property(
 *         property="posicio",
 *         type="string",     
 *     ),
 *     @OA\Property(
 *         property="foto",
 *         type="string",     
 *     ),
 *     @OA\Property(
 *         property="dorsal",
 *         type="integer",     
 *     ),
 *     @OA\Property(
 *         property="data_naixement",
 *         type="string",     
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",     
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",     
 *     ),
 * )
 */

    use HasFactory;

    protected $fillable = ['nom', 'equip_id', 'posicio', 'foto', 'dorsal', 'data_naixement'];
    protected $table = 'jugadors';
    protected $hidden = ['created_at', 'updated_at'];

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }

    public function getEdatAttribute()
    {
        return date_diff(date_create($this->data_naixement), date_create('today'))->y;
    }

    public function __toString()
    {
        return $this->nom;
    }
}

