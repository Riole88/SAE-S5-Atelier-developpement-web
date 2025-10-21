<?php

namespace charlymatloc\core\application\ports\spi\repositoryInterfaces;

use charlymatloc\core\domain\entities\Outil\Outil;
use charlymatloc\core\domain\entities\Panier\Panier;
use charlymatloc\core\domain\entities\Categorie\Categorie;
use charlymatloc\core\domain\entities\Reservation\Reservation;
use charlymatloc\core\domain\entities\User\User;

interface OutilRepositoryInterface {
    public function findOutilById(string $id): Outil;
    public function findPanierById(string $id): Panier;
    public function findCategorieById(string $id): Categorie;
    public function findReservationById(string $id): Reservation;
    public function findUserById(string $id): User;
}