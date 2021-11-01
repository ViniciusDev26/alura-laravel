<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(string $animeId)
    {
        $anime = Anime::find($animeId);
        $seasons = $anime->seasons;

        return view ('seasons.index', compact('anime','seasons'));
    }
}
