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
        private \DateTimeInterface $dateReservation,
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