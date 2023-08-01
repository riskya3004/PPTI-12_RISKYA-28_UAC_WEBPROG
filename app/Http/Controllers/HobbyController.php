<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Http\Requests\StoreHobbyRequest;
use App\Http\Requests\UpdateHobbyRequest;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hobbies = Hobby::all();

        return view('hobbies.index', compact('hobbies'));
    }
    public function create()
    {
        return view('hobbies.create');
    }
    public function store(StoreHobbyRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:hobbies',
        ]);

        Hobby::create([
            'name' => $request->name,
        ]);

        return redirect()->route('hobbies.index')->with('success', 'Hobby has been added successfully.');
    }
    public function edit(Hobby $hobby)
    {
        return view('hobbies.edit', compact('hobby'));
    }
    public function update(UpdateHobbyRequest $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:hobbies,name,' . $hobby->id,
        ]);

        $hobby->update([
            'name' => $request->name,
        ]);

        return redirect()->route('hobbies.index')->with('success', 'Hobby has been updated successfully.');
    }
    public function destroy(Hobby $hobby)
    {
        $hobby->delete();

        return redirect()->route('hobbies.index')->with('success', 'Hobby has been deleted successfully.');
    }
}
