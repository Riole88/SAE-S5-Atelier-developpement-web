<?php

namespace charlymatloc\api\middlewares;

use charlymatloc\api\dto\auth\UserDTO;
use charlymatloc\core\domain\exceptions\UnauthorizedException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware
{
    private string $secretKey;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @throws UnauthorizedException
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 1. Vérif etextraction du token
        $authHeader = $request->getHeaderLine('Authorization');

        if (empty($authHeader)) {
            throw new UnauthorizedException('Token manquant');
        }

        if (!preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            throw new UnauthorizedException('Format du token invalide');
        }

        $token = trim($matches[1]);

        if (empty($token)) {
            throw new UnauthorizedException('Token vide');
        }

        // décoder le token
        try {
            $payload = JWT::decode($token, new Key($this->secretKey, 'HS512'));
        } catch (ExpiredException) {
            throw new UnauthorizedException('Token expiré');
        } catch (SignatureInvalidException) {
            throw new UnauthorizedException('Signature du token invalide');
        } catch (BeforeValidException) {
            throw new UnauthorizedException('Token pas encore valide');
        } catch (\UnexpectedValueException | \DomainException $e) {
            throw new UnauthorizedException('Token invalide: ' . $e->getMessage());
        }

        // on vérifie que la la structure du payload est correct
        if (!isset($payload->sub, $payload->data->id, $payload->data->email)) {
            throw new UnauthorizedException('Payload du token incomplet');
        }

        // créer le profil utilisateur
        try {
            $profile = new UserDTO(
                id: (string) $payload->sub,
                email: $payload->data->email,
                role: (int) $payload->data->role ?? 0
            );
        } catch (\Exception $e) {
            throw new UnauthorizedException('Données utilisateur invalides');
        }

        // ajouter le profil à la requête
        $request = $request->withAttribute('profile', $profile);
        return $handler->handle($request);
    }
}