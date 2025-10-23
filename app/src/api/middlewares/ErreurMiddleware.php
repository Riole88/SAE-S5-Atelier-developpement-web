<?php

namespace charlymatloc\api\middlewares;

use charlymatloc\core\domain\exceptions\EntityNotFoundException;
use charlymatloc\core\domain\exceptions\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class ErreurMiddleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (UnauthorizedException $e) {
            return $this->jsonResponse($e->getMessage(), 401);
        } catch (EntityNotFoundException $e) {
            return $this->jsonResponse($e->getMessage(), 404);
        } catch (\InvalidArgumentException $e) {
            return $this->jsonResponse($e->getMessage(), 400);
        } catch (\Exception $e) {
            // Log l'erreur pour débug
            error_log($e->getMessage() . "\n" . $e->getTraceAsString());

            return $this->jsonResponse('Erreur interne du serveur', 500);
        }
    }

    private function jsonResponse(string $message, int $status): ResponseInterface
    {
        $response = new Response();
        $response->getBody()->write(json_encode([
            'error' => $message,
            'status' => $status
        ], JSON_UNESCAPED_UNICODE));

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus($status);
    }
}