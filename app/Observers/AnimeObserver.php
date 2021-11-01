<?php

namespace App\Observers;

use App\Models\Anime;
use Ramsey\Uuid\Uuid;

class AnimeObserver
{
    public function creating(Anime $animer)
    {
        $animer->id = Uuid::uuid4();
    }
}
