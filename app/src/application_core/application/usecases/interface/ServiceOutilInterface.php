<?php

namespace charlymatloc\core\application\usecases\interface;


use charlymatloc\api\dto\OutilDTO;

interface ServiceOutilInterface {
    public function getOutils(): array;
    public function getOutil(string $id): OutilDTO;
}