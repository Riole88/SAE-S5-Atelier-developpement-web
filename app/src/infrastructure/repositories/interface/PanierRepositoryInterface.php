<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Utilisateur\Panier;

interface PanierRepositoryInterface {
    public function findAllPaniers(): array;
    public function findPanierByOwnerId(string $userId) : Panier;
    public function findAllOutilsByPanierId(string $panierId) : array;
    public function addToCart($dto);
    public function isDisponible($dto);
    public function removeFromCart(string $id_outil, string $id_panier) : void;
    public function updateQuantityFromCart(string $id_outil, int $new_quantity) : void;
    public function save(string $id_user) : void;
}