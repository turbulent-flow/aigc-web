<?php

namespace App\Http\Controllers\API\V0;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\V0\AIGC\Vars;
use App\Libraries\TCPClient;
use App\Libraries\TCPClient\Exception as TCPClientException;
use App\Libraries\TCPClient\Error as TCPClientError;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\V0\AIGCRequest;

class AIGCController extends Controller
{
    public function inquire(AIGCRequest $request): JsonResponse
    {
        $requestData = $this->normalizeRequestData($request);
        $client = TCPClient::build();

        try {
            $client->createSocket()
                ->connectSocket()
                ->writeLine($requestData);
        } catch (\Throwable $e) {
            if ($e instanceof TCPClientException) {
                $error = $e->containedError;

                return response()->json($this->normalizeError($error));
            } else {
                throw $e;
            }
        }

        try {
            $receivedData = $client->readLine();
        } catch (\Throwable $e) {
            if ($e instanceof TCPClientException) {
                $error = $e->containedError;

                return response()->json($this->normalizeError($error));
            } else {
                throw $e;
            }
        }

        $data = json_decode($receivedData, true);

        return response()->json($data);
    }

    private function normalizeError(TCPClientError $error): array
    {
        return [
            'error' => [
                'code' => $error->code,
                'message' => $error->message
            ]
        ];
    }

    private function normalizeRequestData(AIGCRequest $request): string
    {
        return Vars::$operationMappings[$request->operation_type] . ", {{$request->content}}\r\n";
    }
}
