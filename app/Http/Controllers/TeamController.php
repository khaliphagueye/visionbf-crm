<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::withCount('users')->latest()->paginate(10);
        return view('team.index', compact('teams'));
    }

    public function create()
    {
        return view('team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'description' => 'nullable|string|max:1000',
        ]);

        Team::create($validated);

        return redirect()->route('teams.index')->with('success', 'Équipe créée avec succès.');
    }

    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $team->update($validated);

        return redirect()->route('teams.index')->with('success', 'Équipe mise à jour.');
    }

    public function destroy(Team $team)
    {
        // Empêcher la suppression si l'équipe contient des membres
        if ($team->users()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer cette équipe car elle contient des membres.');
        }

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Équipe supprimée avec succès.');
    }
}