<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Utilisateur\Reservation;
use charlymatloc\infra\repositories\interface\ReservationRepositoryInterface;
use PDO;
use Slim\Exception\HttpInternalServerErrorException;
use DI\NotFoundException;
use charlymatloc\core\application\ports\spi\exceptions\EntityNotFoundException;

class PDOReservationRepository implements ReservationRepositoryInterface {

    private PDO $reservation_pdo;

    public function __construct(PDO $pdo) {
        $this->reservation_pdo = $pdo;
    }

    public function findReservationById(string $id): Reservation{
        try{
            $stmt = $this->reservation_pdo->prepare("SELECT * 
            FROM reservation
            WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception de la reservation");
        }

        if(!$reservation){
            throw new EntityNotFoundException("Reservation avec l'id $id pas trouver");
        }
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
        try{
            $stmt = $this->reservation_pdo->query("SELECT * 
            FROM reservation");
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
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

    public function saveReservation(Reservation $reservation): void{
        try{
            $stmt = $this->pdo_user->prepare("INSERT INTO reservation (idUser, dateDebut, dateFin, statut) VALUES (:id_user, :date_debut, :date_fin, :statut)");
            $stmt->execute(['id_user' => $reservation->id_user, 'date_debut' => $reservation->date_debut, 'date_fin' => $reservation->date_fin, 'statut' => $reservation->statut]);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de l'enregistrement des données");
        }
    }

    public function findAllOutilsByReservationId(string $reservationId) : array{
        try{
            $stmt = $this->panier_pdo->prepare("SELECT r.quantite, o.*
            FROM reservation_outil r
            JOIN outil o
            ON r.idoutil = o.id
            WHERE r.idreservation = :id");
            $stmt->execute(['id' => $reservationId]);
            $outils = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des outils");
        }
        if(!$outils){
            throw new EntityNotFoundException("outils de la reservation $reservationId pas trouver");
        }

        $res = [];
         foreach ($outils as $outil) {
            $res[] = ['outil' => new Outil(
                $outil["id"],
                $outil["nom"],
                $outil["description"],
                $outil["image"],
                $outil["tarifjournalier"],
                $outil["quantitestock"],
                $outil["idcat"],
                $outil["cree_par"],
                $outil["cree_quand"],
                $outil["modifie_par"],
                $outil["modifie_quand"]
            ), 'quantite' => $outil["quantite"]];
        }
        return $res;
    }
}