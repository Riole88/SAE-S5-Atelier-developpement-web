<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Outil\Outil;
use charlymatloc\core\domain\entities\Utilisateur\Reservation;
use charlymatloc\infra\repositories\interface\ReservationRepositoryInterface;
use PDO;
use DI\NotFoundException;
use charlymatloc\core\domain\exceptions\EntityNotFoundException;

class PDOReservationRepository implements ReservationRepositoryInterface {

    private PDO $reservation_pdo;

    public function __construct(PDO $pdo) {
        $this->reservation_pdo = $pdo;
    }

    public function findReservationById(string $id): Reservation{
        try{
            $stmt = $this->reservation_pdo->prepare("SELECT * FROM reservation WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception de la reservation");
        }

        if(!$reservation){
            throw new EntityNotFoundException("Reservation avec l'id $id pas trouver");
        }
        return new Reservation(
            $reservation["id"],
            $reservation["id_user"],
            $reservation["date_debut"],
            $reservation["date_fin"],
            $reservation["statut"],
            $reservation["cree_par"],
            $reservation["cree_quand"],
            $reservation["modifie_par"],
            $reservation["modifie_quand"]
        );
    }

    public function findAllReservations(): array{
        try{
            $stmt = $this->reservation_pdo->query("SELECT * FROM reservation");
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des reservations");
        }
        if(!$reservations){
            throw new NotFoundException("Pas de reservations trouvees");
        }
        $res = [];
        foreach ($reservations as $reservation) {
            $res[] = new Reservation(
                $reservation["id"],
                $reservation["id_user"],
                $reservation["date_debut"],
                $reservation["date_fin"],
                $reservation["statut"],
                $reservation["cree_par"],
                $reservation["cree_quand"],
                $reservation["modifie_par"],
                $reservation["modifie_quand"]
            );
        }
        return $res;
    }

    public function saveReservation(Reservation $reservation): void{
        try{
            $stmt = $this->reservation_pdo->prepare("INSERT INTO reservation (id_user, date_debut, date_fin, statut) VALUES (:id_user, :date_debut, :date_fin, :statut)");
            $stmt->execute(['id_user' => $reservation->id_user, 'date_debut' => $reservation->date_debut, 'date_fin' => $reservation->date_fin, 'statut' => $reservation->statut]);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de l'enregistrement des données");
        }
    }

    public function findAllOutilsByReservationId(string $reservationId) : array{
        try{
            $stmt = $this->reservation_pdo->prepare("SELECT r.quantite, o.* FROM reservation_outil r
                                                            JOIN outil o
                                                            ON r.id_outil = o.id
                                                            WHERE r.id_reservation = :id");
            $stmt->execute(['id' => $reservationId]);
            $outils = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des outils");
        }
        if(empty($outils)){
            return [];
        }

        $res = [];
         foreach ($outils as $outil) {
            $res[] = ['outil' => new Outil(
                $outil["id"],
                $outil["nom"],
                $outil["description"],
                $outil["image"],
                $outil["tarif_journalier"],
                $outil["quantite_stock"],
                $outil["id_cat"],
                $outil["cree_par"],
                $outil["cree_quand"],
                $outil["modifie_par"],
                $outil["modifie_quand"]
            ), 'quantite' => $outil["quantite"]];
        }
        return $res;
    }

    public function findReservationsByOwnerId(string $ownerId) : array{
        try{
            $stmt = $this->reservation_pdo->prepare("SELECT * 
            FROM reservation
            WHERE id_user = :ownerId
            AND statut IN ('en_attente', 'confirmee')");
            $stmt->execute(['ownerId' => $ownerId]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des reservations");
        }
        if(!$reservations){
            throw new NotFoundException("Pas de reservations trouvees");
        }
        $res = [];
        foreach ($reservations as $reservation) {
            $res[] = new Reservation(
                $reservation["id"],
                $reservation["id_user"],
                $reservation["date_debut"],
                $reservation["date_fin"],
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