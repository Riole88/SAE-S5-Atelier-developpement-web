<?php

namespace charlymatloc\core\domain\entities\Utilisateur;

use Faker\Core\Uuid;

class Reservation
{
    public function __construct(
        private string $id,
        private string $idUser,
        private string $dateDebut,
        private string $dateFin,
        private string $statut,
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