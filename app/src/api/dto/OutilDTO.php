<?php

namespace charlymatloc\api\dto;


use Exception;

class OutilDTO {
    public function __construct(
        public readonly string $id,
        public readonly string $nom,
        public readonly string $desc,
        public readonly string $image,
        public readonly ?string $tarif_journalier,
        public readonly ?string $quantite_stock,
        public readonly ?string $id_cat,
        public readonly ?string $creer_par,
        public readonly ?string $cree_quand,
        public readonly ?string $modifie_par,
        public readonly ?string $modifie_quand
    ) {}
}