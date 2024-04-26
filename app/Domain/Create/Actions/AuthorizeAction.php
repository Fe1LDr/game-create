<?php

namespace App\Domain\Create\Actions;

class AuthorizeAction
{
    public function execute(array $data): \Exception|array
    {
        try {
            $request = [
                "username" => $data['username'],
                "password" => $data['password'],
            ];
            // TODO: $response = http::post("http://127.0.0.1:8000/users/auth", $request);
            $data["user_id"] = 1;//$response->user_id];
        } catch (\Exception $e) {
            return $e;
        }

        return $data;
    }
}
