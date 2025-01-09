<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partit;
use App\Models\Equip;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PartitsController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partits = Partit::all();
        $partits = Partit::paginate(10);
        $equips = Equip::all();
        return view('partits.index', compact('partits', 'equips'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Partit $partit)
    {
        $local = Equip::findOrFail($partit->equip_local_id);
        $visitant = Equip::findOrFail($partit->equip_visitant_id);
        return view('partits.show', compact('partit', 'local', 'visitant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Partit::class);
        $equips = Equip::all();
        return view('partits.create', compact('equips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartitRequest $request)
    {
        $this->authorize('create', Partit::class);

        $validated = $request->validated();

        $gols = explode('-', $validated['resultat']);
        $validated['gols_local'] = $gols[0] ?? 0;
        $validated['gols_visitant'] = $gols[1] ?? 0;

        Partit::create($validated);

        return redirect()->route('partits.index')->with('success', 'Partit creat correctament.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partit $partit)
    {
        $this->authorize('update', $partit);
        $equips = Equip::all();
        return view('partits.edit', compact('partit', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartitRequest $request, string $id)
    {
        $this->authorize('update', Partit::findOrFail($id));

        $validated = $request->validated();
        
        $gols = explode('-', $validated['resultat']);
        $validated['gols_local'] = $gols[0] ?? 0;
        $validated['gols_visitant'] = $gols[1] ?? 0;
        
        unset($validated['resultat']);
        $partit = Partit::findOrFail($id);
        $partit->update($validated);

        event(new \App\Events\PartitActualizat());

        return redirect()->route('partits.index')->with('success', 'Partit actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Partit::findOrFail($id));
        $partit = Partit::findOrFail($id);
        $partit->delete();

        return redirect()->route('partits.index')->with('success', 'Partit eliminat correctament.');
    }

    public function historic()
    {
        return view('partits.historic');
    }

    public function classificacio()
    {
        return view('partits.classificacio');
    }
}
