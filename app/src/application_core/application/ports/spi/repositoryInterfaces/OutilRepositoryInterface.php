<?php

namespace charlymatloc\core\application\ports\spi\repositoryInterfaces;

use charlymatloc\core\domain\entities\outil\Outil;

interface OutilRepositoryInterface {
    public function findById(string $id): Outil;
}