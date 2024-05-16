<?php

namespace App\Http\ApiV1\Modules\Games\Controllers;

use App\Domain\Create\Actions\AuthorizeAction;
use App\Domain\Create\Actions\ConnectGameAction;
use App\Domain\Create\Actions\CreateGameAction;
use App\Domain\Create\Models\Game;
use App\Http\ApiV1\Modules\Games\Requests\GameConnectOrDestroyRequest;
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
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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
            return response()->json(['errors' => [['code' => "401", 'message' => $e->getMessage()]]], 404);
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
            return response()->json(['data' => [], 'errors' => [['code' => "401", 'message' => $e->getMessage()]]], 401);
        }

        return new GameResource($game);
    }

    /**
     * Connect to the game.
     */
    public function connect(
        GameConnectOrDestroyRequest $request,
        ConnectGameAction $connectAction,
        AuthorizeAction $authorizeAction
    ): JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response {
        try {
            $validate = $request->validated();
            $authorized = $authorizeAction->execute($validate);
            $connectAction->execute($authorized);
        } catch (Exception $e) {
            return response()->json(['data' => [], 'errors' => [['code' => $e->getCode(), 'message' => $e->getMessage()]]], $e->getCode());
        }

        return response(null, ResponseAlias::HTTP_ACCEPTED);
    }

    /**
     * Delete the game.
     */
    public function destroy(GameConnectOrDestroyRequest $request, AuthorizeAction $authorizeAction): JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        try {
            $validate = $request->validated();
            $authorized = $authorizeAction->execute($validate);
            $game = Game::find($authorized['id']);
            if ($game === null) {
                throw new NotFoundResourceException("Game not found", 404);
            }
            if ($authorized['user_id'] == $game->player_white || $authorized['user_id'] == $game->player_black) {
                $game->delete();
            } else {
                throw new UnauthorizedException("Not a game owner", 401);
            }
        } catch (Exception $e) {
            return response()->json(['data' => [], 'errors' => [['code' => $e->getCode(), 'message' => $e->getMessage()]]], $e->getCode());
        }

        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
