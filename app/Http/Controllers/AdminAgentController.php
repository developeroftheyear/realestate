<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'bio' => 'required|string',
            'experience_years' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('agents', 'public');
            $validated['photo'] = $photoPath;
        }

        Agent::create($validated);

        return redirect()->route('admin.agents.index')->with('success', 'Agent created successfully.');
    }

    public function show(Agent $agent)
    {
        return view('admin.agents.show', compact('agent'));
    }

    public function edit(Agent $agent)
    {
        return view('admin.agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'bio' => 'required|string',
            'experience_years' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('photo')) {
            if ($agent->photo) {
                Storage::disk('public')->delete($agent->photo);
            }
            $photoPath = $request->file('photo')->store('agents', 'public');
            $validated['photo'] = $photoPath;
        }

        $agent->update($validated);

        return redirect()->route('admin.agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('admin.agents.index')->with('success', 'Agent deleted successfully.');
    }
}
