<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(10);
        return view('dashboard.agents.agents', compact('agents'));
    }

    public function create()
    {
        return view('dashboard.agents.create');
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

        return redirect()->route('panel.agents.index')->with('success', 'Agent created successfully.');
    }

    public function show(Agent $agent)
    {
        return redirect()->route('panel.agents.edit', $agent);
    }

    public function edit(Agent $agent)
    {
        return view('dashboard.agents.edit', compact('agent'));
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

        return redirect()->route('panel.agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('panel.agents.index')->with('success', 'Agent deleted successfully.');
    }
}
