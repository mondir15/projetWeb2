<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use Illuminate\Http\Request;

class CellierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cellier.addCellier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom_cellier' => 'required',
        ], [
            'nom_cellier.required' => 'Le champ nom_cellier est requis.',
        ]);
    
        // Créer un nouveau cellier dans la base de données
        $cellier = new Cellier;
        $cellier->nom_cellier = $request->input('nom_cellier');
        $cellier->user_id = auth()->user()->id;
        $cellier->save();
    
        // Rediriger vers la page d'accueil avec un message de succès
        // return redirect(route('accueil'))->withSuccess('Cellier enregistré.');
        return redirect()->route('home')->withSuccess('Cellier enregistré.');

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        
        {
            // Retrieve the Cellier object with the given id
            $cellier = Cellier::findOrFail($id);
        
            // Pass the Cellier object to the view for editing
            return view('cellier.modifyCellier', compact('cellier'));
        }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Retrieve the Cellier object with the given id
        $cellier = Cellier::findOrFail($id);
    
        // Validate the form data
        $request->validate([
            'nom_cellier' => 'required',
        ], [
            'nom_cellier.required' => 'Le champ nom_cellier est requis.',
        ]);
    
        // Update the Cellier object with the new values from the form
        $cellier->nom_cellier = $request->input('nom_cellier');
        $cellier->save();
    
        // Redirect to the home page with a success message
        return redirect()->route('home')->withSuccess('Cellier modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Supprimer le cellier de la base de données
        Cellier::destroy($id);
    
        // Rediriger vers la page d'accueil avec un message de succès
        // return redirect(route('accueil'))->withSuccess('Cellier supprimé.');
        return redirect()->route('home')->withSuccess('Cellier supprimé.');
    }
}