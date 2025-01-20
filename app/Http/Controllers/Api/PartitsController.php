<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePartitRequest;
use App\Http\Resources\PartitResource;
use App\Models\Partit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PartitsController extends BaseController
{    
/**
 * @OA\Get(
 *     path="/api/partits",
 *     summary="Llistar partits",
 *     tags={"Partits"},
 *     @OA\Response(
 *         response=200,
 *         description="Llista de partits",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Partit")
 *         )
 *     )
 * )
 */
public function index() 
{
    return PartitResource::collection(Partit::paginate(10));
}

/**
 * @OA\Post(
 *     path="/api/partits",
 *     summary="Crear un partit",
 *     tags={"Partits"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"equipo_local", "equipo_visitante", "fecha", "resultado_local", "resultado_visitante"},
 *             @OA\Property(property="equipo_local", type="string", example="Equipo A"),
 *             @OA\Property(property="equipo_visitante", type="string", example="Equipo B"),
 *             @OA\Property(property="fecha", type="string", format="date-time", example="2025-01-20T18:00:00"),
 *             @OA\Property(property="resultado_local", type="integer", example=2),
 *             @OA\Property(property="resultado_visitante", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Partit creat amb èxit",
 *         @OA\JsonContent(ref="#/components/schemas/Partit")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Petició invàlida"
 *     )
 * )
 */
public function store(StorePartitRequest $request)
{
    $validated = $request->validated();
    $partit = Partit::create($validated);
    return $this->sendResponse($partit, 'Partit creat amb èxit', 201);
}

/**
 * @OA\Get(
 *     path="/api/partits/{id}",
 *     summary="Mostrar un partit",
 *     tags={"Partits"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del partit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Partit recuperat amb èxit",
 *         @OA\JsonContent(ref="#/components/schemas/Partit")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Partit no trobat"
 *     )
 * )
 */
public function show(Partit $partit)
{
    return $this->sendResponse(new PartitResource($partit), 'Partit recuperat amb èxit', 201);
}

/**
 * @OA\Put(
 *     path="/api/partits/{id}",
 *     summary="Actualitzar un partit",
 *     tags={"Partits"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del partit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"equipo_local", "equipo_visitante", "fecha", "resultado_local", "resultado_visitante"},
 *             @OA\Property(property="equipo_local", type="string", example="Equipo A"),
 *             @OA\Property(property="equipo_visitante", type="string", example="Equipo B"),
 *             @OA\Property(property="fecha", type="string", format="date-time", example="2025-01-20T18:00:00"),
 *             @OA\Property(property="resultado_local", type="integer", example=2),
 *             @OA\Property(property="resultado_visitante", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Partit actualitzat amb èxit",
 *         @OA\JsonContent(ref="#/components/schemas/Partit")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Petició invàlida"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Partit no trobat"
 *     )
 * )
 */
public function update(StorePartitRequest $request, Partit $partit)
{
    $partit->update($request->validated());
    return $this->sendResponse($partit, 'Partit actualitzat amb èxit', 201);
}

/**
 * @OA\Delete(
 *     path="/api/partits/{id}",
 *     summary="Eliminar un partit",
 *     tags={"Partits"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del partit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Partit eliminat amb èxit"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Partit no trobat"
 *     )
 * )
 */
public function destroy(Partit $partit)
{
    $partit->delete();
    return $this->sendResponse(null, 'Partit eliminat amb èxit', 201);
}
}