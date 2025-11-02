<?php

namespace charlymatloc\infra\repositories\interface;

use charlymatloc\core\domain\entities\Utilisateur\Reservation;

interface ReservationRepositoryInterface {
    public function findReservationById(string $id): Reservation;
    public function findAllReservations(): array;
    public function saveReservation(string $date_debut, string $date_fin, string $ownerId): void;
    public function findReservationsByOwnerId(string $ownerId) : array;
    public function reservationExists(string $date_debut, string $date_fin, string $ownerId);
    public function addOutilToReservation(array $res, string $ownerId) : void;
}