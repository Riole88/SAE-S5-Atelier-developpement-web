<?php

namespace charlymatloc\api\dto;


use Exception;

class PanierDTO {
    public function __construct(
        public readonly string $id,
        public readonly string $id_user,
        public readonly ?string $cree_par,
        public readonly ?string $cree_quand,
        public readonly ?string $modifie_par,
        public readonly ?string $modifie_quand,
        public readonly array $outils = [],
    ) {}
}