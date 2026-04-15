<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CharacterController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCharacter($request);

        Character::create($validated);

        return redirect()->to(route('dashboard').'#sell')->with('status', 'Listing posted.');
    }

    public function update(Request $request, Character $character): RedirectResponse
    {
        $validated = $this->validateCharacter($request);

        $character->update($validated);

        return redirect()->to(route('dashboard').'#manage')->with('status', 'Listing updated.');
    }

    public function destroy(Character $character): RedirectResponse
    {
        $character->delete();

        return redirect()->to(route('dashboard').'#manage')->with('status', 'Listing removed.');
    }

    public function buy(Character $character): RedirectResponse
    {
        $name = $character->name;
        $character->delete();

        return redirect()->to(route('dashboard').'#market')->with('status', "Purchased {$name}.");
    }

    /**
     * @return array{name: string, element: string, image_url: string, sort_order: int}
     */
    private function validateCharacter(Request $request): array
    {
        $catalog = Character::catalog();

        /** @var array{name: string, sort_order?: int|null} $validated */
        $validated = $request->validate([
            'name' => ['required', 'string', Rule::in(Character::catalogNames())],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        /** @var array{element: string, image_url: string} $details */
        $details = $catalog[$validated['name']];

        return [
            'name' => $validated['name'],
            'element' => $details['element'],
            'image_url' => $details['image_url'],
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ];
    }
}
