<?php

namespace charlymatloc\core\application\usecases;

use charlymatloc\api\dto\OutilDTO;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use charlymatloc\core\domain\entities\Outil\Outil;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;

class ServiceOutil implements ServiceOutilInterface {
    private OutilRepositoryInterface $outilRepository;

    public function __construct(OutilRepositoryInterface $outilRepository)
    {
        $this->outilRepository = $outilRepository;
    }

    /**
     * @throws \Exception
     */
    public function getOutils(): array {
//        try {
        $outils = $this->outilRepository->findAllOutils();
//        } catch (\Exception $e) {
//            throw new \Exception($e->getMessage());
//        }

        $res = [];
        foreach ($outils as $outil) {
            $res[] = new OutilDTO(
                $outil->id,
                $outil->nom,
                $outil->description,
                $outil->image,
                $outil->tarif_journalier,
                $outil->quantite_stock,
                $outil->id_cat,
                $outil->cree_par,
                $outil->cree_quand,
                $outil->modifie_par,
                $outil->modifie_quand
            );
        }
        return $res;
    }

    /**
     * @throws \Exception
     */
    public function getOutil(string $id): OutilDTO
    {
//        try {
            $outil = $this->outilRepository->findOutilById($id);
//        } catch (EntityNotFoundException $e) {
//            throw new EntityNotFoundException($e->getEntity()." not found", $e->getEntity());
//        } catch (\Exception $e) {
//            throw new \Exception("probleme lors de la reception du patient.", $e->getCode());
//        }

        return new OutilDTO(
            $outil->id,
            $outil->nom,
            $outil->description,
            $outil->image,
            $outil->tarifJournalier,
            $outil->quantiteStock,
            $outil->idCat,
            $outil->creePar,
            $outil->creeQuand,
            $outil->modifiePar,
            $outil->modifieQuand
        );
    }
}