<?php

namespace App\services;

use App\Models\Anime;

class AnimeCreatorService
{
    public function execute(string $name, int $seasons, int $episodes)
    {
        $anime = Anime::create([
            'name' => $name
        ]);

        for($i = 0; $i < $seasons; $i++){
            $season = $anime->seasons()->create([
                'number' => $i
            ]);

            for($j = 0; $j < $episodes; $j++){
                $season->episodes()->create([
                    'number' => $j
                ]);
            }
        }

        return $anime;
    }
}
