<?php

namespace charlymatloc\core\domain\entities\Outil;

use Faker\Core\Uuid;

class Outil {
    public function __construct(
        private Uuid $id,
        private string $nom,
        private string $desc,
        private string $image,
        private float $tarifJournalier,
        private int $quantite,
        private Uuid $idCat,
        private ?Uuid $creePar,
        private \DateTimeImmutable $creeQuand,
        private ?Uuid $modifiePar,
        private \DateTimeImmutable $modifieQuand)
    {}

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTarifJournalier(): float
    {
        return $this->tarifJournalier;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getIdCat(): Uuid
    {
        return $this->idCat;
    }

    public function getCreePar(): Uuid
    {
        return $this->creePar;
    }

    public function getCreeQuand(): \DateTimeImmutable
    {
        return $this->creeQuand;
    }

    public function getModifiePar(): Uuid
    {
        return $this->modifiePar;
    }

    public function getModifieQuand(): \DateTimeImmutable
    {
        return $this->modifieQuand;
    }
}