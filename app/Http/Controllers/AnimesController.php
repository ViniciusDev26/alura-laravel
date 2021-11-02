<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimesFormRequest;
use App\Models\Anime;
use App\services\AnimeCreatorService;
use App\services\AnimeDestructorService;
use Illuminate\Http\Request;

class AnimesController extends Controller
{
    public function index() {
        $animes = Anime::query()->orderBy('name')->get();

        return view('animes.index', compact('animes'));
    }

    public function create() {
        return view('animes.create');
    }

    public function store(AnimesFormRequest $request, AnimeCreatorService $animeCreatorService)
    {
        $name = $request->get('name');
        $seasons = $request->get('seasons');
        $episodes = $request->get('episodes');


        try{
            $animeCreatorService->execute($name, $seasons, $episodes);
        }catch (\Exception $error) {
            return redirect('animes')
                ->with('status', false)
                ->with('message', 'Erro ao cadastrar o Anime');
        }


        return redirect('animes')
            ->with('status', true)
            ->with('message', 'Anime cadastrado com sucesso');
    }

    public function destroy(Request $request, AnimeDestructorService $animeDestructorService)
    {
        $uuid = $request->route('anime');

        try{
            $anime = $animeDestructorService->execute($uuid);
        }catch (\Exception $error){
            return redirect('animes')
                ->with('status', false)
                ->with('message', $error->getMessage());
        }

        return redirect('animes')
            ->with('status', true)
            ->with('message', "Anime \"$anime->name\" deletado com sucesso");
    }

    public function update(string $id, Request $request)
    {
        $name = $request->get('name');

        $anime = Anime::find($id);
        $anime->name = $name;
        $anime->save();
    }
}
