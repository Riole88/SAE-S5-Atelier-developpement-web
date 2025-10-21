<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\outil\Outil;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use PDO;

class PDOOutilRepository implements OutilRepositoryInterface {

    private PDO $outil_pdo;

    public function __construct(PDO $pdo) {
        $this->outil_pdo = $pdo;
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