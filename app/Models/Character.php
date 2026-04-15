<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * @var array<string, array{element: string, image_url: string}>
     */
    public const CATALOG = [
        'Yae Miko' => [
            'element' => 'Electro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/4/49/Character_Yae_Miko_Full_Wish.png/revision/latest?cb=20220507154303',
        ],
        'Raiden Shogun' => [
            'element' => 'Electro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003',
        ],
        'Raiden' => [
            'element' => 'Electro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a3/Character_Raiden_Shogun_Full_Wish.png/revision/latest?cb=20220507154003',
        ],
        'Neuvillette' => [
            'element' => 'Hydro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/5/5e/Character_Neuvillette_Full_Wish.png/revision/latest?cb=20230814030603',
        ],
        'Furina' => [
            'element' => 'Hydro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/9/94/Character_Furina_Full_Wish.png/revision/latest?cb=20231021031756',
        ],
        'Arlecchino' => [
            'element' => 'Pyro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/2/24/Character_Arlecchino_Full_Wish.png/revision/latest?cb=20240415074433',
        ],
        'Navia' => [
            'element' => 'Geo',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/c/c2/Character_Navia_Full_Wish.png/revision/latest?cb=20231206210847',
        ],
        'Nahida' => [
            'element' => 'Dendro',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/f/fd/Character_Nahida_Full_Wish.png/revision/latest?cb=20220926190359',
        ],
        'Kazuha' => [
            'element' => 'Anemo',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/3/38/Character_Kaedehara_Kazuha_Full_Wish.png/revision/latest?cb=20220507153453',
        ],
        'Ayaka' => [
            'element' => 'Cryo',
            'image_url' => 'https://static.wikia.nocookie.net/gensin-impact/images/a/a5/Character_Kamisato_Ayaka_Full_Wish.png/revision/latest?cb=20220507153557',
        ],
    ];

    protected $fillable = [
        'name',
        'element',
        'image_url',
        'sort_order',
    ];

    /**
     * @return array<string, array{element: string, image_url: string}>
     */
    public static function catalog(): array
    {
        return self::CATALOG;
    }

    /**
     * @return list<string>
     */
    public static function catalogNames(): array
    {
        return array_keys(self::CATALOG);
    }
}
