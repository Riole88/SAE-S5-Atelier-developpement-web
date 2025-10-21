<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Outil\Outil;

interface OutilRepositoryInterface {
    public function findOutilById(string $id): Outil;
    public function findAllOutils(): array;
}