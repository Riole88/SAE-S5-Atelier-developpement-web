<?php

namespace charlymatloc\core\application\usecases\interface;


use charlymatloc\core\domain\entities\Outil\Outil;

interface ServiceOutilInterface {
    public function getOutils(): array;
    public function getOutil(string $id): Outil;
}