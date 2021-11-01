<?php

namespace App\services;

use App\Models\Anime;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class AnimeDestructorService
{

    /**
     * @param Season $season
     */
    private function destroyEpisodes(Season $season) {
        Episode::where('season_id', $season->id)->each(function (Episode $episode) {
            $episode->delete();
        });
    }

    /**
     * @param Anime $anime
     */
    private function destroySeasons(Anime $anime) {
        $anime->seasons->each(function(Season $season) {
            $this->destroyEpisodes($season);
            $season->delete();
        });
    }

    /**
     * @param Anime $anime
     */
    private function destroyAnime(Anime $anime): void
    {
        $this->destroySeasons($anime);
        $anime->delete();
    }

    public function execute(string $uuid)
    {
        DB::beginTransaction();

        $anime = Anime::find($uuid);
        $this->destroyAnime($anime);

        DB::commit();

        return $anime;
    }
}
