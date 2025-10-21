<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\outil\Categorie;
use charlymatloc\infra\repositories\interface\CategorieRepositoryInterface;
use PDO;

class PDOCategorieRepository implements CategorieRepositoryInterface {

    private PDO $cat_pdo;

    public function __construct(PDO $pdo) {
        $this->cat_pdo = $pdo;
    }

    public function findCategorieById(string $id): Categorie{
        $stmt = $this->cat_pdo->prepare("SELECT * 
        FROM categorie
        WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Categorie(
            $categorie["id"],
            $categorie["nom"],
            $categorie["description"],
            $categorie["cree_par"],
            $categorie["cree_quand"],
            $categorie["modifie_par"],
            $categorie["modifie_quand"]
        );
    }

    public function findAllCategories(): array{
        $stmt = $this->cat_pdo->query("SELECT * 
        FROM categorie");
        $stmt->execute(['id' => $id]);
        $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($outils as $outil) {
            $res[] = new Categorie(
                $categorie["id"],
                $categorie["nom"],
                $categorie["description"],
                $categorie["cree_par"],
                $categorie["cree_quand"],
                $categorie["modifie_par"],
                $categorie["modifie_quand"]
            );
        }

        return $res;
    }
}