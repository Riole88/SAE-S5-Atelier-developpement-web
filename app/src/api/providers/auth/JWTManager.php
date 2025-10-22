<?php

namespace charlymatloc\api\providers\auth;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

class JWTManager
{

    private string $secret;

    public function __construct()
    {
        $this->secret = $_ENV['JWT_SECRET'];
    }


    public function createAccessToken(array $payload): string
    {
        return JWT::encode([ 'iss'=>'http://auth.myapp.net',
            'aud'=>'http://api.myapp.net',
            'iat'=>time(),
            'exp'=>time()+900,
            'sub' => $payload['id'],
            'data' => $payload
        ], $this->secret, 'HS512');
    }

    public function createRefreshToken(array $payload): string
    {
        return JWT::encode([ 'iss'=>'http://auth.myapp.net',
            'aud'=>'http://api.myapp.net',
            'iat'=>time(),
            'exp'=>time()+3600,
            'sub' => $payload['id'],
            'data' => $payload
        ], $this->secret, 'HS512');
    }

    /**
     * @throws InvalidJWTTokenException
     */
    public function decodeToken(string $token): array
    {
        try {
            $tokenArray = JWT::decode($token, new Key($this->secret, 'HS512'));
        } catch (ExpiredException $e) {
            throw new InvalidJWTTokenException("Token expiré");
        } catch (SignatureInvalidException | \UnexpectedValueException | \DomainException $e) {
            throw new InvalidJWTTokenException("invalid jwt token");
        }
        return (array) $tokenArray->data;
    }
}