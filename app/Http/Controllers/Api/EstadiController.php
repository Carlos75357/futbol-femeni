<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Estadi;
use App\Models\Equip;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use App\Http\Resources\EstadiResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EstadiController extends BaseController
{
    use AuthorizesRequests;

    /**
     * @OA\Get(
     *     path="/api/estadis",
     *     summary="Llista estadis",
     *     tags={"estadis"},
     *     @OA\Response(
     *         response=200,
     *         description="Llista de estadis",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Estadi")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return EstadiResource::collection(Estadi::paginate(10));
    }

    /**
     * @OA\Post(
     *     path="/api/estadis",
     *     summary="Crear un nou estadi",
     *     tags={"estadis"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Estadi")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Estadi creat amb èxit",
     *         @OA\JsonContent(ref="#/components/schemas/Estadi")
     *     )
     * )
     */
    public function store(StoreEstadiRequest $request)
    {
        $validated = $request->validated();
        $estadi = Estadi::create($validated);
        return $this->sendResponse($estadi, 'Estadi creat amb èxit', 201);
    }

    /**
     * @OA\Get(
     *     path="/api/estadis/{id}",
     *     summary="Mostrar un estadi",
     *     tags={"estadis"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'estadi",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalls de l'estadi",
     *         @OA\JsonContent(ref="#/components/schemas/Estadi")
     *     )
     * )
     */
    public function show(Estadi $estadi)
    {
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi recuperat amb èxit', 200);
    }

    /**
     * @OA\Put(
     *     path="/api/estadis/{id}",
     *     summary="Actualitzar un estadi",
     *     tags={"estadis"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'estadi",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Estadi")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Estadi actualitzat amb èxit",
     *         @OA\JsonContent(ref="#/components/schemas/Estadi")
     *     )
     * )
     */
    public function update(StoreEstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());
        return $this->sendResponse($estadi, 'Estadi actualitzat amb èxit', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/estadis/{id}",
     *     summary="Eliminar un estadi",
     *     tags={"estadis"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l'estadi",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Estadi eliminat amb èxit",
     *         @OA\JsonContent(type="string", example="Estadi eliminat amb èxit")
     *     )
     * )
     */
    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return $this->sendResponse(null, 'Estadi eliminat amb èxit', 200);
    }
}