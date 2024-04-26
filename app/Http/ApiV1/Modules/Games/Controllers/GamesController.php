<?php

namespace App\Http\ApiV1\Modules\Games\Controllers;

use App\Domain\Create\Actions\AuthorizeAction;
use App\Domain\Create\Actions\ConnectGameAction;
use App\Domain\Create\Actions\CreateGameAction;
use App\Domain\Create\Models\Game;
use App\Http\ApiV1\Modules\Games\Requests\GameRequest;
use App\Http\ApiV1\Modules\Games\Resources\GameResource;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAll(): JsonResponse|AnonymousResourceCollection
    {
        try {
            return GameResource::collection(Game::all());
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    /**
     * Create the new game.
     */
    public function create(GameRequest $request, CreateGameAction $gameAction, AuthorizeAction $authorizeAction): GameResource|JsonResponse
    {
        try {
            $validate = $request->validated();
            $authorized = $authorizeAction->execute($validate);
            $game = $gameAction->execute($authorized);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }

        return new GameResource($game);
    }

    /**
     * Connect to the game.
     */
    public function connect(
        GameRequest $request,
        ConnectGameAction $gameAction,
        AuthorizeAction $authorizeAction
    ): JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response {
        try {
            $validate = $request->validated();
            $authorized = $authorizeAction->execute($validate);
            $error = $gameAction->execute($authorized);
            if ($error != null) {
                return response()->json($error->getMessage(), 404);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }

        return response(null, ResponseAlias::HTTP_ACCEPTED);
    }

    /**
     * Delete the game.
     */
    public function destroy(GameRequest $request, AuthorizeAction $authorizeAction): JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        try {
            $validate = $request->validated();
            $authorized = $authorizeAction->execute($validate);
            $game = Game::find($authorized['id']);
            if ($authorized['user_id'] == $game->player_white || $authorized['user_id'] == $game->player_black) {
                $game->delete();
            } else {
                throw new UnauthorizedException("Not a game owner");
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
