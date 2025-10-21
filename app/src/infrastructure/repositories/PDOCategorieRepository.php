<?php

namespace charlymatloc\infra\repositories;

use charlymatloc\core\domain\entities\outil\Categorie;
use charlymatloc\core\domain\exceptions\EntityNotFoundException;
use charlymatloc\infra\repositories\interface\CategorieRepositoryInterface;
use PDO;
use Slim\Exception\HttpInternalServerErrorException;
use DI\NotFoundException;


class PDOCategorieRepository implements CategorieRepositoryInterface {

    private PDO $cat_pdo;

    public function __construct(PDO $pdo) {
        $this->cat_pdo = $pdo;
    }

    public function findCategorieById(string $id): Categorie{
        try{
            $stmt = $this->cat_pdo->prepare("SELECT * FROM categorie WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception de la categorie");
        }

        if(!$categorie){
            throw new EntityNotFoundException("Categorie avec l'id $id pas trouver");
        }

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
        try{
            $stmt = $this->cat_pdo->query("SELECT * FROM categorie");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(HttpInternalServerErrorException){
            throw new HttpInternalServerErrorException("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception des categories");
        }
        if(!$categories){
            throw new NotFoundException("Pas de categories trouvees");
        }

        $res = [];
        foreach ($categories as $categorie) {
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