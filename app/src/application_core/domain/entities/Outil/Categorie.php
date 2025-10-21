<?php

namespace charlymatloc\core\domain\entities\Outil;

use DateTimeInterface;

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
    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreePar(): ?string
    {
        return $this->cree_par;
    }

    public function getCreeQuand(): ?string
    {
        return $this->cree_quand;
    }

    public function getModifiePar(): ?string
    {
        return $this->modifie_par;
    }

    public function getModifieQuand(): ?string
    {
        return $this->modifie_quand;
    }

    // --- Setters ---
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setModifiePar(?string $modifiePar): void
    {
        $this->modifie_par = $modifiePar;
    }

    public function setModifieQuand(?string $modifieQuand): void
    {
        $this->modifie_quand = $modifieQuand;
    }
}
