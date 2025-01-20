<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Resources\EquipResource;
use App\Models\Equip;
use Illuminate\Http\Request;

class EquipController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/equips",
     *     summary="Llista equips",
     *     tags={"equips"},
     *     @OA\Response(
     *         response=200,
     *         description="Llista de equips",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Equip")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return EquipResource::collection(Equip::paginate(10));
    }

    /**
     * @OA\Post(
     *     path="/api/equips",
     *     summary="Crear un nou equip",
     *     tags={"equips"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Equip")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Equip creat amb èxit",
     *         @OA\JsonContent(ref="#/components/schemas/Equip")
     *     )
     * )
     */
    public function store(StoreEquipRequest $request)
    {
        $validated = $request->validated();
        $equip = Equip::create($validated);
        return $this->sendResponse($equip, 'Equip creat amb èxit', 201);
    }

    /**
     * @OA\Get(
     *     path="/api/equips/{id}",
     *     summary="Mostrar un equip",
     *     tags={"equips"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'equip",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalls de l'equip",
     *         @OA\JsonContent(ref="#/components/schemas/Equip")
     *     )
     * )
     */
    public function show(Equip $equip)
    {
        return $this->sendResponse(new EquipResource($equip), 'Equip recuperat amb èxit', 200);
    }

    /**
     * @OA\Put(
     *     path="/api/equips/{id}",
     *     summary="Actualitzar un equip",
     *     tags={"equips"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'equip",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Equip")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Equip actualitzat amb èxit",
     *         @OA\JsonContent(ref="#/components/schemas/Equip")
     *     )
     * )
     */
    public function update(StoreEquipRequest $request, Equip $equip)
    {
        $equip->update($request->validated());
        return $this->sendResponse($equip, 'Equip actualitzat amb èxit', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/equips/{id}",
     *     summary="Eliminar un equip",
     *     tags={"equips"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'equip",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Equip eliminat amb èxit",
     *         @OA\JsonContent(type="string", example="Equip eliminat amb èxit")
     *     )
     * )
     */
    public function destroy(Equip $equip)
    {
        $equip->delete();
        return $this->sendResponse(null, 'Equip eliminat amb èxit', 200);
    }
}