<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Utilisateur\Reservation;
use charlymatloc\infra\repositories\interface\ReservationRepositoryInterface;
use PDO;

class PDOReservationRepository implements ReservationRepositoryInterface {

    private PDO $reservation_pdo;

    public function __construct(PDO $pdo) {
        $this->reservation_pdo = $pdo;
    }

    public function findReservationById(string $id): Panier{
        $stmt = $this->reservation_pdo->prepare("SELECT * 
        FROM reservation
        WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Reservation(
            $reservation["id"],
            $reservation["iduser"],
            $reservation["datedebut"],
            $reservation["datefin"],
            $reservation["statut"],
            $reservation["cree_par"],
            $reservation["cree_quand"],
            $reservation["modifie_par"],
            $reservation["modifie_quand"]
        );
    }

    public function findAllReservations(): array{
        $stmt = $this->reservation_pdo->query("SELECT * 
        FROM reservation");
        $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($outils as $outil) {
            $res[] = new Reservation(
                $reservation["id"],
                $reservation["iduser"],
                $reservation["datedebut"],
                $reservation["datefin"],
                $reservation["statut"],
                $reservation["cree_par"],
                $reservation["cree_quand"],
                $reservation["modifie_par"],
                $reservation["modifie_quand"]
            );
        }
        return $res;
    }

    
}