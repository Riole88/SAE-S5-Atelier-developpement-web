<?php

namespace charlymatloc\core\domain\entities\Outil;

class Categorie
{
    private string $id;
    private string $nom;
    private ?string $description;

    private ?string $cree_par;
    private ?string $cree_quand;
    private ?string $modifie_par;
    private ?string $modifie_quand;

    public function __construct(
        string             $id,
        string             $nom,
        ?string            $description = null,
        ?string            $creePar = null,
        ?string $creeQuand = null,
        ?string            $modifiePar = null,
        ?string $modifieQuand = null
    )
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->cree_par = $creePar;
        $this->cree_quand = $creeQuand;
        $this->modifie_par = $modifiePar;
        $this->modifie_quand = $modifieQuand;
    }

    // --- Getters ---
    public function __get(string $name){
        if(property_exists($this,$name)) {
            return $this->$name;
        }
        throw new \Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }

    // --- Setters ---
    public function __set(string $name, string $valeur){
        if(property_exists($this,$name)) {
            $this->$name = $valeur;
        } else {
            throw new \Exception("Propriété '$name' inexistante dans " . __CLASS__);
        }
    }
}
