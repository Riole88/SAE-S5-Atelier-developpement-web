<?php

namespace charlymatloc\core\domain\entities\Outil;

use Exception;
use Faker\Core\Uuid;

class Outil {
    public function __construct(
        private string $id,
        private string $nom,
        private string $description,
        private string $image,
        private float $tarifJournalier,
        private int $quantiteStock,
        private string $idCat,
        private ?string $creePar,
        private ?string $creeQuand,
        private ?string $modifiePar,
        private ?string $modifieQuand)
    {}

    /**
     * @throws Exception
     */
    public function __get(string $property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new Exception("La propriété '$property' n'existe pas.");
    }
}