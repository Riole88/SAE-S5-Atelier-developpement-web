<?php

namespace charlymatloc\core\application\usecases\interface;

use charlymatloc\api\dto\InputPanierDTO;

interface ServicePanierInterface {
    public function getPanier(string $id_user): array;
    public function ajouterPanier(InputPanierDTO $dto): array;
    public function validerPanier(string $id_user): array;
}