<?php

namespace charlymatloc\core\domain\entities\Utilisateur;

use Faker\Core\Uuid;

class Reservation
{
    public function __construct(
        private Uuid $id,
        private Uuid $idUser,
        private \DateTimeInterface $dateDebut,
        private \DateTimeInterface $dateFin,
        private string $statut,
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