<?php

namespace charlymatloc\api\dto;


class ReservationOutilDTO {
    public function __construct(
        public readonly string $id,
        public readonly string $id_reservation,
        public readonly string $id_outil,
        public readonly int $quantite,
        public readonly ?string $cree_par,
        public readonly ?string $cree_quand,
        public readonly ?string $modifie_par,
        public readonly ?string $modifie_quand
    ) {}
}
