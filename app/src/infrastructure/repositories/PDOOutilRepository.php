<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\outil\Outil;
//use charlymatloc\core\domain\entities\Panier\Panier;
//use charlymatloc\core\domain\entities\Categorie\Categorie;
//use charlymatloc\core\domain\entities\Reservation\Reservation;
//use charlymatloc\core\domain\entities\User\User;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use PDO;

class PDOOutilRepository implements OutilRepositoryInterface {

    private PDO $outil_pdo;

    public function __construct(PDO $patient_pdo) {
        $this->outil_pdo = $patient_pdo;
    }

    public function findOutilById(string $id): Outil{
        $stmt = $this->outil_pdo->prepare("SELECT * FROM outil WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $outil = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Outil(
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
        );
    }

//    public function findPanierById(string $id): Panier{
//        $stmt = $this->pdo->prepare("SELECT *
//        FROM panier
//        WHERE id = :id");
//        $stmt->execute(['id' => $id]);
//        $outil = $stmt->fetch(PDO::FETCH_ASSOC);
//        return new Outil(
//            $outil["id"],
//            $outil["idUser"],
//            $outil["cree_par"],
//            $outil["cree_quand"],
//            $outil["modifie_par"],
//            $outil["modifie_quand"]
//        );
//    }

//    public function findCategorieById(string $id): Categorie{
//        $stmt = $this->pdo->prepare("SELECT *
//        FROM categorie
//        WHERE id = :id");
//        $stmt->execute(['id' => $id]);
//        $outil = $stmt->fetch(PDO::FETCH_ASSOC);
//        return new Outil(
//            $outil["id"],
//            $outil["nom"],
//            $outil["description"],
//            $outil["image"],
//            $outil["tarifjournalier"],
//            $outil["quantitestock"],
//            $outil["idcat"],
//            $outil["cree_par"],
//            $outil["cree_quand"],
//            $outil["modifie_par"],
//            $outil["modifie_quand"]
//        );
//    }

//    public function findReservationById(string $id): Reservation{
//        $stmt = $this->pdo->prepare("SELECT *
//        FROM reservation
//        WHERE id = :id");
//        $stmt->execute(['id' => $id]);
//        $outil = $stmt->fetch(PDO::FETCH_ASSOC);
//        return new Outil(
//            $outil["id"],
//            $outil["nom"],
//            $outil["description"],
//            $outil["image"],
//            $outil["tarifjournalier"],
//            $outil["quantitestock"],
//            $outil["idcat"],
//            $outil["cree_par"],
//            $outil["cree_quand"],
//            $outil["modifie_par"],
//            $outil["modifie_quand"]
//        );
//    }
//
//    public function findUserById(string $id): User{
//        $stmt = $this->pdo->prepare("SELECT *
//        FROM users
//        WHERE id = :id");
//        $stmt->execute(['id' => $id]);
//        $outil = $stmt->fetch(PDO::FETCH_ASSOC);
//        return new Outil(
//            $outil["id"],
//            $outil["nom"],
//            $outil["description"],
//            $outil["image"],
//            $outil["tarifjournalier"],
//            $outil["quantitestock"],
//            $outil["idcat"],
//            $outil["cree_par"],
//            $outil["cree_quand"],
//            $outil["modifie_par"],
//            $outil["modifie_quand"]
//        );
//    }

    public function findAllOutils(): array
    {
//        try {
            $stmt = $this->outil_pdo->query("SELECT * FROM outil");
            $outils = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $res = [];
            foreach ($outils as $outil) {
                $res[] = new Outil(
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
                );
            }
//        } catch (\Throwable $e) {
//            throw new Exception($e->getMessage());
//        }
        return $res;
    }
}