<?php

namespace charlymatloc\core\application\ports\spi;

use charlymatloc\core\domain\entities\outil\Outil;
use charlymatloc\core\domain\entities\Panier\Panier;
use charlymatloc\core\domain\entities\Categorie\Categorie;
use charlymatloc\core\domain\entities\Reservation\Reservation;
use charlymatloc\core\domain\entities\User\User;

class OutilRepository implements OutilRepositoryInterface {
    public function findOutilById(string $id): Outil{
        $stmt = $this->pdo->prepare("SELECT * 
        FROM outil
        WHERE id = :id");
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

    public function findPanierById(string $id): Panier{
        $stmt = $this->pdo->prepare("SELECT * 
        FROM panier
        WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $outil = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Outil(
            $outil["id"],
            $outil["idUser"],
            $outil["cree_par"],
            $outil["cree_quand"],
            $outil["modifie_par"],
            $outil["modifie_quand"]
        );
    }

    public function findCategorieById(string $id): Categorie{
        $stmt = $this->pdo->prepare("SELECT * 
        FROM categorie
        WHERE id = :id");
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

    public function findReservationById(string $id): Reservation{
        $stmt = $this->pdo->prepare("SELECT * 
        FROM reservation
        WHERE id = :id");
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

    public function findUserById(string $id): User{
        $stmt = $this->pdo->prepare("SELECT * 
        FROM users
        WHERE id = :id");
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
}