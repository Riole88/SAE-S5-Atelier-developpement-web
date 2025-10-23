<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Utilisateur\Reservation;

interface ReservationRepositoryInterface {
    public function findReservationById(string $id): Reservation;
    public function findAllReservations(): array;
    public function saveReservation(Reservation $reservation): void;
    public function findReservationsByOwnerId(string $ownerId) : array;
}