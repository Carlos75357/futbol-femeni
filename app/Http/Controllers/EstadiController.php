<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadi;
use App\Models\Equip;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EstadiController extends Controller
{    
    use AuthorizesRequests;
    public function index() {
        $estadis = Estadi::all();
        $estadis = Estadi::paginate(10);
        return view('estadis.index', compact('estadis'));
    }    

    public function show(Estadi $estadi)
    {
        $equips = Equip::all();
        $estadi->equips = $estadi->equips->map(function ($equip) {
            return [
                'id' => $equip->id,
                'nom' => $equip->nom,
            ];
        });
        return view('estadis.show', compact('estadi'));
    }

    public function create()
    {
        $this->authorize('create', Estadi::class);
        $equips = Equip::all();
        return view('estadis.create', compact('equips'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadiRequest $request)
    {
        $this->authorize('create', Estadi::class);
        $validated = $request->validated();
    
        Estadi::create($validated);
    
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament!');
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estadi $estadi)
    {
        $this->authorize('update', $estadi);

        $equips = Equip::all();
        return view('estadis.edit', compact('estadi', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadiRequest $request, string $id)
    {
        $this->authorize('update', Estadi::findOrFail($id));

        $validated = $request->validated();

        $estadi = Estadi::findOrFail($id);
        $estadi->update($validated);

        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadi $estadi)
    {
        $this->authorize('delete', $estadi);
        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi esborrat correctament!');
    }
}
