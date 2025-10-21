<?php

namespace charlymatloc\core\domain\entities\Outil;

use DateTimeInterface;

class Categorie
{
    private string $id;
    private string $nom;
    private ?string $description;

    private ?string $creePar;
    private ?DateTimeInterface $creeQuand;
    private ?string $modifiePar;
    private ?DateTimeInterface $modifieQuand;

    public function __construct(
        string             $id,
        string             $nom,
        ?string            $description = null,
        ?string            $creePar = null,
        ?DateTimeInterface $creeQuand = null,
        ?string            $modifiePar = null,
        ?DateTimeInterface $modifieQuand = null
    )
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->creePar = $creePar;
        $this->creeQuand = $creeQuand;
        $this->modifiePar = $modifiePar;
        $this->modifieQuand = $modifieQuand;
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
        return $this->creePar;
    }

    public function getCreeQuand(): ?DateTimeInterface
    {
        return $this->creeQuand;
    }

    public function getModifiePar(): ?string
    {
        return $this->modifiePar;
    }

    public function getModifieQuand(): ?DateTimeInterface
    {
        return $this->modifieQuand;
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
        $this->modifiePar = $modifiePar;
    }

    public function setModifieQuand(?DateTimeInterface $modifieQuand): void
    {
        $this->modifieQuand = $modifieQuand;
    }
}
