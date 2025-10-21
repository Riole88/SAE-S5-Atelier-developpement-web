<?php

namespace charlymatloc\api\dto;

use Exception;

class InputPanierDTO {
    private string $id_user;
    private string $id_outil;
    private string $quantite;
    private string $date_reservation;

    public function __construct(array $data) {
        $this->id_user = $data['id_user'];
        $this->id_outil = $data['id_outil'];
        $this->quantite = $data['quantite'];
        $this->date_reservation = $data['date_reservation'];
    }

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
