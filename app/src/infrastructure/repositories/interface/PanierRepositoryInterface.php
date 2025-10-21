<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Utilisateur\Panier;

interface PanierRepositoryInterface {
    public function findPanierById(string $id): Panier;
    public function findAllPaniers(): array;
    public function findPanierByOwnerId(string $userId) : Panier;
    public function addToCart($dto);
    public function isDisponible($dto);
}