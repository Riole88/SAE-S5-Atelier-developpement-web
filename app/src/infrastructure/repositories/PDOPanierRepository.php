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
        try{
        $stmt = $this->panier_pdo->prepare("SELECT * 
            FROM panier
            WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
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
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
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

    
}