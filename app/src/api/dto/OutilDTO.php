<?php

namespace charlymatloc\api\dto;


use Exception;

class OutilDTO {
    public function __construct(
        public readonly string $id,
        public readonly string $nom,
        public readonly string $desc,
        public readonly string $image,
        public readonly ?string $tarifJournalier,
        public readonly ?string $quantite,
        public readonly ?string $idCat,
        public readonly ?string $creerPar,
        public readonly ?string $creeQuand,
        public readonly ?string $modifiePar,
        public readonly ?string $modifieQuand
    ) {}
}