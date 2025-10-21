<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Outil\Outil;
use charlymatloc\core\domain\exceptions\EntityNotFoundException;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use PDO;
use DI\NotFoundException;

class PDOOutilRepository implements OutilRepositoryInterface {

    private PDO $outil_pdo;

    public function __construct(PDO $pdo) {
        $this->outil_pdo = $pdo;
    }

    public function findOutilById(string $id): Outil{
        try{
            $stmt = $this->outil_pdo->prepare("SELECT * FROM outil WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $outil = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception de l'outil");
        }

        if(!$outil){
            throw new EntityNotFoundException("Outil avec l'id $id pas trouver");
        }

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
        try {
            $stmt = $this->outil_pdo->query("SELECT * FROM outil");
            $outils = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $res = [];
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des outils");
        }
        if(!$outils){
            throw new NotFoundException("Pas d'outils trouvees");
        }
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
        return $res;
    }
}