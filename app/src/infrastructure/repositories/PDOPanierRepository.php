<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Utilisateur\Panier;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use PDO;

class PDOPanierRepository implements PanierRepositoryInterface {

    private PDO $panier_pdo;

    public function __construct(PDO $pdo) {
        $this->panier_pdo = $pdo;
    }

    public function findPanierById(string $id): Panier{
        $stmt = $this->panier_pdo->prepare("SELECT * 
        FROM panier
        WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Panier(
            $panier["id"],
            $panier["idUser"],
            $panier["cree_par"],
            $panier["cree_quand"],
            $panier["modifie_par"],
            $panier["modifie_quand"]
        );
    }

    public function findAllPaniers(): array{
        $stmt = $this->panier_pdo->query("SELECT * 
        FROM panier");
        $paniers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($paniers as $panier) {
            $res[] = new Panier(
                $panier["id"],
                $panier["idUser"],
                $panier["cree_par"],
                $panier["cree_quand"],
                $panier["modifie_par"],
                $panier["modifie_quand"]
            );
        }

        return $res;
    }

    
}