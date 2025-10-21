<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Utilisateur\Panier;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use PDO;
use DI\NotFoundException;
use charlymatloc\core\application\ports\spi\exceptions\EntityNotFoundException;
use charlymatloc\core\domain\entities\outil\Outil;

class PDOPanierRepository implements PanierRepositoryInterface {

    private PDO $panier_pdo;

    public function __construct(PDO $pdo) {
        $this->panier_pdo = $pdo;
    }

    public function findPanierById(string $id): Panier{
        try{
        $stmt = $this->panier_pdo->prepare("SELECT * 
            FROM panier
            WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception du panier");
        }

        if(!$panier){
            throw new EntityNotFoundException("Panier avec l'id $id pas trouver");
        }
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
        try{
            $stmt = $this->panier_pdo->query("SELECT * 
            FROM panier");
            $paniers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des paniers");
        }
        if(!$paniers){
            throw new NotFoundException("Pas de paniers trouvees");
        }
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

    public function findPanierByOwnerId(string $userId) : Panier{
        try{
            $stmt = $this->panier_pdo->prepare("SELECT * 
            FROM panier
            WHERE idUser = :id");
            $stmt->execute(['id' => $userId]);
            $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception du panier");
        }
        if(!$panier){
            throw new EntityNotFoundException("Panier avec l'id d'utilisateur $userId pas trouver");
        }
        return new Panier(
            $panier["id"],
            $panier["idUser"],
            $panier["cree_par"],
            $panier["cree_quand"],
            $panier["modifie_par"],
            $panier["modifie_quand"]
        );
    }
    
    public function findAllOutilsByPanierId(string $panierId) : array{
        try{
            $stmt = $this->panier_pdo->prepare("SELECT p.quantite, o.*
            FROM panier_outil p
            JOIN outil o
            ON p.idoutil = o.id
            WHERE p.idpanier = :id");
            $stmt->execute(['id' => $panierId]);
            $outils = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des outils");
        }
        if(!$outils){
            throw new EntityNotFoundException("outils du panier $panierId pas trouver");
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