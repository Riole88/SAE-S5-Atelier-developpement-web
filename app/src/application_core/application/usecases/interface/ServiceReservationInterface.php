<?php

namespace charlymatloc\core\application\usecases\interface;

//use charlymatloc\api\dto\InputReservationDTO;

interface ServiceReservationInterface {
    public function getReservations(string $id_user): array;
    //public function ajouterReservation(InputReservationDTO $dto): array;
}