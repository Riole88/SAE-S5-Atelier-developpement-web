<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Outil\Categorie;

interface CategorieRepositoryInterface {
    public function findCategorieById(string $id): Categorie;
    public function findAllCategories(): array;
}