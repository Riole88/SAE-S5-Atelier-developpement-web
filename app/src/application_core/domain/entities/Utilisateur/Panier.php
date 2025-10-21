<?php

namespace charlymatloc\core\domain\entities\Utilisateur;

class Panier
{
    public function __construct(
        private string $id,
        private string $id_user,
        private ?string $cree_par,
        private string $cree_quand,
        private ?string $modifie_par,
        private string $modifie_quand
    ){}
    public function __get(string $name){
        if(property_exists($this,$name)) {
            return $this->$name;
        }
        throw new \Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }
}