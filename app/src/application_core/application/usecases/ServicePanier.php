<?php

namespace charlymatloc\core\application\usecases;

use charlymatloc\api\dto\ReservationOutilDTO;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use charlymatloc\api\dto\InputPanierDTO;

class ServicePanier implements ServicePanierInterface {
    private PanierRepositoryInterface $panierRepository;

    public function __construct(PanierRepositoryInterface $panierRepository)
    {
        $this->panierRepository = $panierRepository;
    }

    public function getPaniers(): array {
        $paniers = $this->panierRepository->findAllPaniers();
        $res = [];
        foreach ($paniers as $panier) {
            $res[] = new ReservationOutilDTO(
                $panier->id,
                $panier->id_reservation,
                $panier->id_outil,
                $panier->quantite,
                $panier->cree_par,
                $panier->cree_quand,
                $panier->modifie_par,
                $panier->modifie_quand
            );

        }
        return $res;
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