<?php

namespace charlymatloc\core\application\usecases\interface;

use charlymatloc\api\dto\InputPanierDTO;

interface ServicePanierInterface {
    public function getPaniers(): array;
    public function ajouterPanier(InputPanierDTO $dto): array;
}