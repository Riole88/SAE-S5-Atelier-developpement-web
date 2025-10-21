<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Utilisateur\Panier;

interface PanierRepositoryInterface {
    public function findPanierById(string $id): Panier;
    public function findAllPaniers(): array;
}