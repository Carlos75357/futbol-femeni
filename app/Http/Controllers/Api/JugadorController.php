<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Resources\JugadorResource;
use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadorController extends BaseController
{

   /**
 * @OA\Get(
 *     path="/api/jugadores",
 *     summary="Llistar jugadors",
 *     tags={"Jugadors"},
 *     @OA\Response(
 *         response=200,
 *         description="Llista de jugadors",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Jugador")
 *         )
 *     )
 * )
 */
public function index()
{
    return JugadorResource::collection(Jugador::paginate(10));
}

/**
 * @OA\Post(
 *     path="/api/jugadores",
 *     summary="Crear un jugador",
 *     tags={"Jugadors"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nombre", "posicion", "foto"},
 *             @OA\Property(property="nombre", type="string", example="Carlos"),
 *             @OA\Property(property="posicion", type="string", example="Delantero"),
 *             @OA\Property(property="foto", type="string", format="binary")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Jugador creat amb èxit",
 *         @OA\JsonContent(ref="#/components/schemas/Jugador")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Petició invàlida"
 *     )
 * )
 */
public function store(StoreJugadoraRequest $request)
{
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('jugadors', 'public');
        $request->merge(['foto' => $path]);
    }

    $validated = $request->validated();
    $jugadore = Jugador::create($validated);
    return $this->sendResponse($jugadore, 'Jugador Creada amb exit',201);
}

/**
 * @OA\Get(
 *     path="/api/jugadores/{id}",
 *     summary="Mostrar un jugador",
 *     tags={"Jugadors"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del jugador",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Jugador recuperat amb èxit",
 *         @OA\JsonContent(ref="#/components/schemas/Jugador")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Jugador no trobat"
 *     )
 * )
 */
public function show(Jugador $jugadore)
{
    return $this->sendResponse(new JugadorResource($jugadore), 'Jugador Recuperada amb exit', 201);
}

/**
 * @OA\Put(
 *     path="/api/jugadores/{id}",
 *     summary="Actualitzar un jugador",
 *     tags={"Jugadors"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del jugador",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nombre", "posicion"},
 *             @OA\Property(property="nombre", type="string", example="Carlos"),
 *             @OA\Property(property="posicion", type="string", example="Delantero"),
 *             @OA\Property(property="foto", type="string", format="binary")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Jugador actualitzat amb èxit",
 *         @OA\JsonContent(ref="#/components/schemas/Jugador")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Petició invàlida"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Jugador no trobat"
 *     )
 * )
 */
public function update(StoreJugadoraRequest $request, Jugador $jugadore)
{
    $jugadore->update($request->validated());
    return $this->sendResponse($jugadore, 'Jugador Actualitzada amb exit', 201);
}

/**
 * @OA\Delete(
 *     path="/api/jugadores/{id}",
 *     summary="Eliminar un jugador",
 *     tags={"Jugadors"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del jugador",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Jugador eliminat amb èxit"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Jugador no trobat"
 *     )
 * )
 */
public function destroy(Jugador $jugadore)
{
    $jugadore->delete();
    return $this->sendResponse(null, 'Jugador Eliminada amb exit', 201);
}
}
