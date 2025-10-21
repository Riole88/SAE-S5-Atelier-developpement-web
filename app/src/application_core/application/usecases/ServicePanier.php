<?php

namespace charlymatloc\core\application\usecases;

use charlymatloc\api\dto\OutilDTO;
use charlymatloc\api\dto\PanierDTO;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use charlymatloc\api\dto\InputPanierDTO;

class ServicePanier implements ServicePanierInterface {
    private PanierRepositoryInterface $panierRepository;

    public function __construct(PanierRepositoryInterface $panierRepository)
    {
        $this->panierRepository = $panierRepository;
    }

    public function getPanier(string $id_user): array {
        $panier_rec = $this->panierRepository->findPanierByOwnerId($id_user);
        $paniers = $this->panierRepository->findAllOutilsByPanierId($panier_rec->id);

        $outilsDTO = [];
        foreach ($paniers as $panier) {
            $outil = $panier['outil'];
            $outilsDTO[] = new OutilDTO(
                $outil->id,
                $outil->nom,
                $outil->description ?? null,
                $outil->image ?? null,
                $outil->tarif_journalier ?? null,
                $outil->quantite_stock ?? null,
                $outil->id_cat ?? null,
                $outil->cree_par ?? null,
                $outil->cree_quand ?? null,
                $outil->modifie_par ?? null,
                $outil->modifie_quand ?? null,
                $panier['quantite'] ?? null
            );
        }

        return [
            new PanierDTO(
                $panier_rec->id,
                $panier_rec->id_user,
                $panier_rec->cree_par ?? null,
                $panier_rec->cree_quand ?? null,
                $panier_rec->modifie_par ?? null,
                $panier_rec->modifie_quand ?? null,
                $outilsDTO
            )
        ];
    }



    public function ajouterPanier(InputPanierDTO $dto): array
    {
        try {
            if (!$this->panierRepository->isDisponible($dto)) {
                return [
                    'success' => false,
                    "message" => "L'outil n'est pas disponible."
                ];
            } else {
                $this->panierRepository->addToCart($dto);
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                "message" => $e->getMessage()
            ];
        }
        return [
            'success' => true,
            "message" => "Outil ajoute au panier."
        ];
    }
}