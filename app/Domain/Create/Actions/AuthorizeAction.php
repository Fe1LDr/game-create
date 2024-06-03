<?php

namespace App\Domain\Create\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\UnauthorizedException;

class AuthorizeAction
{
    public function execute(array $data): \Exception|array
    {
        $response = http::post("http://users-nginx/user/auth", [
            "username" => $data['username'],
            "password" => $data['password'],
            ]);
        $obj = json_decode($response);
        if ($response->status() == 200) {
            $data["user_id"] = $obj->{'data'}->{'id'};
        } else {
            throw new UnauthorizedException($obj->{'error'}->{'message'}, 401);
        }

        return $data;
    }
}
