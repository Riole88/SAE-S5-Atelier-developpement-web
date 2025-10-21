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
        private float $tarif_journalier,
        private int $quantite_stock,
        private string $id_cat,
        private ?string $cree_par,
        private ?string $cree_quand,
        private ?string $modifie_par,
        private ?string $modifie_quand)
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