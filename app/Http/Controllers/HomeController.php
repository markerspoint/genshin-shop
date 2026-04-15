<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $defaultCharacters = collect([
            ['id' => null, 'name' => 'Yae Miko', 'element' => 'Electro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/4/49/Character_Yae_Miko_Full_Wish.png/revision/latest?cb=20220507154303', 'sort_order' => 1],
            ['id' => null, 'name' => 'Raiden', 'element' => 'Electro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003', 'sort_order' => 2],
            ['id' => null, 'name' => 'Neuvillette', 'element' => 'Hydro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/5/5e/Character_Neuvillette_Full_Wish.png/revision/latest?cb=20230814030603', 'sort_order' => 3],
            ['id' => null, 'name' => 'Furina', 'element' => 'Hydro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/9/94/Character_Furina_Full_Wish.png/revision/latest?cb=20231021031756', 'sort_order' => 4],
            ['id' => null, 'name' => 'Yae Miko', 'element' => 'Electro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/4/49/Character_Yae_Miko_Full_Wish.png/revision/latest?cb=20220507154303', 'sort_order' => 5],
            ['id' => null, 'name' => 'Raiden', 'element' => 'Electro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003', 'sort_order' => 6],
            ['id' => null, 'name' => 'Neuvillette', 'element' => 'Hydro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/5/5e/Character_Neuvillette_Full_Wish.png/revision/latest?cb=20230814030603', 'sort_order' => 7],
            ['id' => null, 'name' => 'Furina', 'element' => 'Hydro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/9/94/Character_Furina_Full_Wish.png/revision/latest?cb=20231021031756', 'sort_order' => 8],
            ['id' => null, 'name' => 'Yae Miko', 'element' => 'Electro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/4/49/Character_Yae_Miko_Full_Wish.png/revision/latest?cb=20220507154303', 'sort_order' => 9],
            ['id' => null, 'name' => 'Raiden', 'element' => 'Electro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003', 'sort_order' => 10],
            ['id' => null, 'name' => 'Neuvillette', 'element' => 'Hydro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/5/5e/Character_Neuvillette_Full_Wish.png/revision/latest?cb=20230814030603', 'sort_order' => 11],
            ['id' => null, 'name' => 'Furina', 'element' => 'Hydro', 'image' => 'https://static.wikia.nocookie.net/gensin-impact/images/9/94/Character_Furina_Full_Wish.png/revision/latest?cb=20231021031756', 'sort_order' => 12],
        ]);

        $crudEnabled = Schema::hasTable('characters');
        $characters = $defaultCharacters;

        if ($crudEnabled) {
            $dbCharacters = $this->getDatabaseCharacters();
            $characters = $dbCharacters->isNotEmpty() ? $dbCharacters : $defaultCharacters;
        }

        return view('welcome', [
            'characters' => $characters,
        ]);
    }

    /**
     * @return Collection<int, array{id: int, name: string, element: string, image: string, sort_order: int}>
     */
    private function getDatabaseCharacters(): Collection
    {
        return Character::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (Character $character) => [
                'id' => $character->id,
                'name' => $character->name,
                'element' => $character->element,
                'image' => $character->image_url,
                'sort_order' => $character->sort_order,
            ]);
    }
}
