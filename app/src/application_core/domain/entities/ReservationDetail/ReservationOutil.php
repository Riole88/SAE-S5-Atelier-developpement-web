<?php

namespace charlymatloc\core\domain\entities\ReservationDetail;

use Faker\Core\Uuid;

class ReservationOutil
{
    public function __construct(
        private Uuid $id,
        private Uuid $idReservation,
        private Uuid $idOutil,
        private int $quantite,
        private ?Uuid $creePar,
        private \DateTimeInterface $creeQuand,
        private ?Uuid $modifiePar,
        private \DateTimeInterface $modifieQuand
    ){}

    public function __get(string $name){
        if(property_exists($this,$name)) {
            return $this->$name;
        }
        throw new \Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }
}