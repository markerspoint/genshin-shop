<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCharacter($request);

        Character::create($validated);

        return redirect()->to(route('dashboard').'#characters-admin')->with('status', 'Character created.');
    }

    public function update(Request $request, Character $character): RedirectResponse
    {
        $validated = $this->validateCharacter($request);

        $character->update($validated);

        return redirect()->to(route('dashboard').'#characters-admin')->with('status', 'Character updated.');
    }

    public function destroy(Character $character): RedirectResponse
    {
        $character->delete();

        return redirect()->to(route('dashboard').'#characters-admin')->with('status', 'Character deleted.');
    }

    /**
     * @return array{name: string, element: string, image_url: string, sort_order: int}
     */
    private function validateCharacter(Request $request): array
    {
        /** @var array{name: string, element: string, image_url: string, sort_order?: int|null} $validated */
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'element' => ['required', 'string', 'in:Anemo,Cryo,Dendro,Electro,Geo,Hydro,Pyro'],
            'image_url' => ['required', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        return [
            'name' => $validated['name'],
            'element' => $validated['element'],
            'image_url' => $validated['image_url'],
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ];
    }
}
