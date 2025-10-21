<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\api\actions\ReserverOutilAction;
use charlymatloc\core\domain\entities\PanierDetail\PanierOutil;
use charlymatloc\core\domain\entities\Utilisateur\Panier;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use Exception;
use Faker\Core\Uuid;
use PDO;
use Slim\Exception\HttpInternalServerErrorException;
use DI\NotFoundException;
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

    public function findPanierByOwnerId(string $userId) : Panier{
        try{
        $stmt = $this->panier_pdo->prepare("SELECT * 
            FROM panier
            WHERE idUser = :id");
            $stmt->execute(['id' => $userId]);
            $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
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


    public function addToCart($dto) {
        try {
            //on recupere l'id du panier grace a l'id user
            $id_panier_row = $this->panier_pdo->query("SELECT id FROM panier WHERE iduser='$dto->id_user'")
                                                ->fetch(PDO::FETCH_ASSOC);
            $id_panier = $id_panier_row['id'];

            //on insere l'outil dans le panier
            $stmt = $this->panier_pdo->prepare("
                INSERT INTO panier_outil (idpanier, idoutil, quantite, datereservation)
                VALUES (:id_panier, :id_outil, :quantite, :date_reservation)
            ");

            $stmt->execute([
                'id_panier' => $id_panier,
                'id_outil' => $dto->id_outil,
                'quantite' => $dto->quantite,
                'date_reservation' => $dto->date_reservation
            ]);

            $stmt = $this->panier_pdo->prepare("
                INSERT INTO panier_outil (idpanier, idoutil, quantite, datereservation)
                VALUES (:id_panier, :id_outil, :quantite, :date_reservation)
            ");

            //on met a jour la quantite
            $stmt2 = $this->panier_pdo->prepare("
                UPDATE outil
                SET quantitestock = quantitestock - :quantite
                WHERE id = :id_outil
                AND quantitestock >= :quantite
            ");

            $stmt2->execute([
                'quantite' => $dto->quantite,
                'id_outil' => $dto->id_outil
            ]);

        } catch (HttpInternalServerErrorException) {
            //500
            throw new Exception("Erreur lors de l'execution de la requete SQL.");
        } catch(\Throwable $e) {
            throw new Exception("Erreur lors de la création du rendez-vous.");
        }
    }

    public function isDisponible($dto)
    {
        try {
            $quantiteStock = $this->panier_pdo->query("SELECT outil.quantitestock FROM outil WHERE outil.id = '$dto->id_outil'")
                                            ->fetch(PDO::FETCH_ASSOC);
        } catch (HttpInternalServerErrorException) {
            //500
            throw new Exception("Erreur lors de l'execution de la requete SQL.");
        } catch(\Throwable $e) {
            throw new Exception("Erreur lors de la création du rendez-vous.");
        }

        if ($quantiteStock < 1) {
            return false;
        } else {
            return true;
        }

    }
}