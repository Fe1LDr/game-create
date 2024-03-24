<?php

namespace App\Http\ApiV1\Modules\Games\Controllers;

use App\Domain\Create\Models\Games;
use App\Http\ApiV1\Modules\Games\Requests\GameRequest;
use App\Http\ApiV1\Modules\Games\Resources\GameResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GameResource::collection(Games::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameRequest $request)
    {
        $game = Games::create($request->validated());

        return new GameResource($game);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new GameResource(Games::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameRequest $request, Games $game)
    {
        $game->update($request->validated());

        return $game;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Games $game)
    {
        $game->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
