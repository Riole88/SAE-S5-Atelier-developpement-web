<?php

namespace charlymatloc\api\dto;


class ReservationDTO {
    public function __construct(
        public readonly string $id,
        public readonly string $id_user,
        public readonly string $date_debut,
        public readonly string $date_fin,
        public readonly string $statut,
        public readonly ?string $cree_par,
        public readonly string $cree_quand,
        public readonly ?string $modifie_par,
        public readonly string $modifie_quand,
        public readonly array $outils = [],
    ) {}
}
