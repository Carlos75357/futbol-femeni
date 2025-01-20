<?php

namespace App\Policies;

use App\Models\Jugador;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JugadorPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // dd no funciona en policies, var_dump si, porque dd utiliza una excepcion para mostrar la informacion y
        // las excepciones no se propagan a traves de las policies, por lo que no se muestra nada. Esto es asi porque
        // las policies se ejecutan en el contexto de una excepcion de tipo Gate, por lo que si se lanza una excepcion
        // desde una policy, esa excepcion se pierde y no se muestra en la pantalla, por lo que el dd no funciona
        var_dump($user->role, $user->role === 'manager');
        return $user->role === 'manager' || $user->role === 'administrador';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Jugador $jugador): bool
    {
        return $user->role === 'manager' && $user->equip_id === $jugador->equip_id || $user->role === 'administrador';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Jugador $jugador): bool
    {
        return $user->role === 'manager' && $user->equip_id === $jugador->equip_id || $user->role === 'administrador';
    }
}

