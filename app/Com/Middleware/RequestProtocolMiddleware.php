<?php

namespace App\Com\Middleware;


use Closure;
use Symfony\Component\HttpFoundation\ParameterBag;

class RequestProtocolMiddleware
{
    public function handle($request, Closure $next)
    {
        $requestData = $request->request->all();

        $requestData = $this->callDataToJson($requestData);

        $request->request = new ParameterBag($requestData);

        return $next($request);
    }

    protected function callDataToJson($requestData)
    {
        if (!empty($requestData['body']['sign_type']) && $requestData['body']['sign_type'] == 'base64') {
            $requestData['call']['data'] = base64_decode($requestData['call']['data']);
        }
        $requestData = json_decode($requestData['call']['data'], true);
        return $requestData;
    }
}