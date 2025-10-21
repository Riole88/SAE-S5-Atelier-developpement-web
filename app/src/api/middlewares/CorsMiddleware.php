<?php
namespace charlymatloc\api\middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware {
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

        $origin = $request->hasHeader('Origin') ? $request->getHeaderLine('Origin') : '*';

        $response = $handler->handle($request);

        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', $requestHeaders)
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    }
}
