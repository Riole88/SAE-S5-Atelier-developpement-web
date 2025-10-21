<?php

namespace charlymatloc\core\domain\entities\PanierDetail;

use Faker\Core\Uuid;

class PanierOutil
{
    public function __construct(
        private Uuid $id,
        private Uuid $idPanier,
        private Uuid $idOutil,
        private int $quantite,
        private \DateTimeImmutable $dateReservation,
        private ?Uuid $creePar,
        private \DateTimeImmutable $creeQuand,
        private ?Uuid $modifiePar,
        private \DateTimeImmutable $modifieQuand
    ){}

    public function __get(string $name){
        if(property_exists($this,$name)) {
            return $this->$name;
        }
        throw new Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }
}