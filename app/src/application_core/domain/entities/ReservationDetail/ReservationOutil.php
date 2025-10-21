<?php

namespace charlymatloc\core\domain\entities\ReservationDetail;

use Faker\Core\Uuid;

class ReservationOutil
{
    public function __construct(
        private string $id,
        private string $idReservation,
        private string $idOutil,
        private int $quantite,
        private ?string $creePar,
        private string $creeQuand,
        private ?string $modifiePar,
        private string $modifieQuand
    ){}

    public function __get(string $name){
        if(property_exists($this,$name)) {
            return $this->$name;
        }
        throw new \Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }
}