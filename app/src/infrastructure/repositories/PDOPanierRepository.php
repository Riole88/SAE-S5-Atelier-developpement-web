<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\Outil\Outil;
use charlymatloc\core\domain\entities\Utilisateur\Panier;
use charlymatloc\core\domain\exceptions\EntityNotFoundException;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use PDO;
use DI\NotFoundException;
use Slim\Exception\HttpInternalServerErrorException;

class PDOPanierRepository implements PanierRepositoryInterface {

    private PDO $panier_pdo;

    public function __construct(PDO $pdo) {
        $this->panier_pdo = $pdo;
    }

    public function findAllPaniers(): array{
        try{
            $stmt = $this->panier_pdo->query("SELECT * FROM panier");
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
                $panier["id_user"],
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
            $panier = $this->panier_pdo->query("SELECT * FROM panier WHERE id_user = '$userId'")->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requete.");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception du panier.");
        }
        if(!$panier){
            throw new EntityNotFoundException("Panier avec l'id d'utilisateur $userId introuvable.");
        }
        return new Panier(
            $panier["id"],
            $panier["id_user"],
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
                                                        ON p.id_outil = o.id
                                                        WHERE p.id_panier = :id");
            $stmt->execute(['id' => $panierId]);
            $outils = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
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
                $outil["tarif_journalier"],
                $outil["quantite_stock"],
                $outil["id_cat"],
                $outil["cree_par"],
                $outil["cree_quand"],
                $outil["modifie_par"],
                $outil["modifie_quand"]
            ), 'quantite' => $outil["quantite"]];
        }
        return $res;
    }


    public function addToCart($dto) {
        try {
            //on recupere l'id du panier grace a l'id user
            $id_panier_row = $this->panier_pdo->query("SELECT id FROM panier WHERE id_user='$dto->id_user'")
                                                ->fetch(PDO::FETCH_ASSOC);
            $id_panier = $id_panier_row['id'];

            //on insere l'outil dans le panier
            $stmt = $this->panier_pdo->prepare("
                INSERT INTO panier_outil (id_panier, id_outil, quantite, date_reservation)
                VALUES (:id_panier, :id_outil, :quantite, :date_reservation)
            ");

            $stmt->execute([
                'id_panier' => $id_panier,
                'id_outil' => $dto->id_outil,
                'quantite' => $dto->quantite,
                'date_reservation' => $dto->date_reservation
            ]);

            //mise à jour de la quantite
            $stmt2 = $this->panier_pdo->prepare('SELECT quantite_stock FROM outil WHERE id = :outilId');
            $stmt2->execute(['outilId' => $dto->id_outil]);
            $quantite_stock = $stmt2->fetch(PDO::FETCH_ASSOC);
            $quantite = ((int)$quantite_stock['quantite_stock'] - (int)$dto->quantite);
            $stmt3 = $this->panier_pdo->prepare('UPDATE outil
            SET quantite_stock = :quantite 
            WHERE id = :outilId');
            $stmt3->execute(['quantite' => $quantite,'outilId' => $dto->id_outil]);


        } catch (HttpInternalServerErrorException) {
            //500
            throw new \Exception("Erreur lors de l'execution de la requete SQL.");
        } catch(\Throwable $e) {
            throw new \Exception("Erreur lors de la création du panier.");
        }
    }

    public function isDisponible($dto)
    {
        try {
            $quantiteStock = $this->panier_pdo->query("SELECT quantite_stock FROM outil WHERE outil.id = '$dto->id_outil'")
                                            ->fetch(PDO::FETCH_ASSOC);
        } catch (HttpInternalServerErrorException) {
            //500
            throw new \Exception("Erreur lors de l'execution de la requete SQL.");
        } catch(\Throwable $e) {
            throw new \Exception("Erreur lors de la création du rendez-vous.");
        }

        if ($quantiteStock['quantite_stock'] < $dto->quantite) {
            return false;
        } else {
            return true;
        }

    }

    public function removeFromCart(string $id_outil) : void{
        try{
            //recherche de la quantite mis dans le panier
            $quantite_panier = $this->panier_pdo->query("SELECT quantite FROM panier_outil WHERE id_outil = '$id_outil'")
                                            ->fetch(PDO::FETCH_ASSOC);
            //recherche de la quantite en stock
            $quantite_totale = $this->panier_pdo->query("SELECT quantite_stock FROM outil WHERE id = '$id_outil'")
                                            ->fetch(PDO::FETCH_ASSOC);
            // calcul de la nouvelle quantite en stock
            $nouvelle_quantite = (int)$quantite_panier['quantite'] + (int)$quantite_totale['quantite_stock'];

            //mise à jour de la quantite en stock
            $stmt = $this->panier_pdo->prepare('UPDATE outil
            SET quantite_stock = :quantite 
            WHERE id = :id_outil');
            $stmt->execute(['quantite' => $nouvelle_quantite,'id_outil' => $id_outil]);

            //suppression de l'outil dans le panier
            $stmt2 = $this->panier_pdo->query("DELETE FROM panier_outil WHERE id_outil = '$id_outil'");

        } catch (HttpInternalServerErrorException) {
            //500
            throw new \Exception("Erreur lors de l'execution de la requete SQL.");
        } catch(\Throwable $e) {
            throw new \Exception("Erreur lors de la modification du panier.");
        }
    }

    public function updateQuantityFromCart(string $id_outil, int $new_quantity) : void{
        try{
            //recherche de la quantite en stock
            $quantite_totale = $this->panier_pdo->query("SELECT quantite_stock FROM outil WHERE id = '$id_outil'")
                                            ->fetch(PDO::FETCH_ASSOC);
            
            //recherche de la quantite mis dans le panier
            $quantite_panier = $this->panier_pdo->query("SELECT quantite FROM panier_outil WHERE id_outil = '$id_outil'")
                                            ->fetch(PDO::FETCH_ASSOC);
            
            //calcul de la difference entre la quantite actuelle et celle mis à jour
            $difference_quantite = $new_quantity - (int)$quantite_panier['quantite'];
            
            // calcul de la nouvelle quantite en stock
            $nouvelle_quantite = (int)$quantite_totale['quantite_stock'] - $difference_quantite;
            
            //mise à jour de la quantite en stock
            $stmt = $this->panier_pdo->prepare('UPDATE outil
            SET quantite_stock = :quantite 
            WHERE id = :id_outil');
            $stmt->execute(['quantite' => $nouvelle_quantite,'id_outil' => $id_outil]);

            //mise à jour de la quantite dans panier_outil
            $stmt2 = $this->panier_pdo->query("UPDATE panier_outil SET quantite = $new_quantity WHERE id_outil = '$id_outil'");
        } catch (HttpInternalServerErrorException) {
            //500
            throw new \Exception("Erreur lors de l'execution de la requete SQL.");
        } catch(\Throwable $e) {
            throw new \Exception("Erreur lors de la modification du panier.");
        }
    }
}