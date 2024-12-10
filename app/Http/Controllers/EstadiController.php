<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadi;
use App\Models\Equip;

class EstadiController extends Controller
{    

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
        $equips = Equip::all();
        return view('estadis.create', compact('equips'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|unique:estadis',
            'ciutat' => 'required',
            'capacitat' => 'required|integer|min:0',
            'equip_principal_id' => 'nullable|exists:equips,id',
        ]);
    
        Estadi::create($validated);
    
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament!');
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estadi $estadi)
    {
        $equips = Equip::all();
        return view('estadis.edit', compact('estadi', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nom' => 'required|unique:estadis,nom,' . $id,
            'ciutat' => 'required',
            'capacitat' => 'required|integer|min:0',
            'equip_principal_id' => 'nullable|exists:equips,id',
        ]);

        $estadi = Estadi::findOrFail($id);
        $estadi->update($validated);

        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi esborrat correctament!');
    }
}
