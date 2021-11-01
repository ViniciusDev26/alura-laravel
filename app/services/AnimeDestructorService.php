<?php

namespace App\services;

use App\Models\Anime;
use App\Models\Episodes;
use App\Models\Season;

class AnimeDestructorService
{
    public function execute(string $uuid)
    {
        $anime = Anime::find($uuid);
        $anime->seasons->each(function(Season $season) {
            $season->episodes->each(function(Episodes $episode) {
                $episode->delete();
            });

            $season->delete();
        });

        $anime->delete();

        return $anime;
    }
}
