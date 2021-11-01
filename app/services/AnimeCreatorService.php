<?php

namespace App\services;

use App\Models\Anime;
use Illuminate\Support\Facades\DB;

class AnimeCreatorService
{
    private function createAnime(string $name)
    {
        return Anime::create([
            'name' => $name
        ]);
    }

    private function createEpisodes($season, int $numberOfEpisodesPerSeason)
    {
        for($j = 0; $j < $numberOfEpisodesPerSeason; $j++){
            $season->episodes()->create([
                'number' => $j
            ]);
        }
    }

    private function createSeasons(Anime $anime, int $numberOfSeasons, int $numberOfEpisodesPerSeason)
    {
        for($i = 1; $i < $numberOfSeasons; $i++){
            $season = $anime->seasons()->create([
                'number' => $i
            ]);

            $this->createEpisodes($season, $numberOfEpisodesPerSeason);
        }
    }

    public function execute(string $name, int $seasons, int $episodes): Anime | null
    {
        DB::beginTransaction();

        $anime = $this->createAnime($name);
        $this->createSeasons($anime, $seasons, $episodes);

        DB::commit();

        return $anime;
    }
}
