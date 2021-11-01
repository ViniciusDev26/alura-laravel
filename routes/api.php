<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Anime;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/animes', function(Request $request) {
    $data = \App\Models\Anime::all();

    return $data;
});

Route::post('/animes', function(Request $request) {
    try {
        Anime::create([
            "name" => $request->name
        ]);
    }catch (\Exception $err){
        return [
            "status" => false,
            "message" => $err->getMessage()
        ];
    }


    return [
        "status" => true,
        "message" => "Sucesso ao cadastrar o anime"
    ];
});
