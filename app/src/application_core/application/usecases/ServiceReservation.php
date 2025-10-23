<?php

namespace charlymatloc\core\application\usecases;

use charlymatloc\api\dto\OutilDTO;
use charlymatloc\api\dto\ReservationDTO;
use charlymatloc\core\application\usecases\interface\ServiceReservationInterface;
use charlymatloc\infra\repositories\interface\ReservationRepositoryInterface;

class ServiceReservation implements ServiceReservationInterface{
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function getReservations(string $id_user): array{
        try{
            $reservations = $this->reservationRepository->findReservationsByOwnerId($id_user);
        } catch (EntityNotFoundException $e) {
            throw new EntityNotFoundException($e->getEntity()." not found", $e->getEntity());
        } catch (\Exception $e) {
            throw new \Exception("probleme lors de la reception des reservations.", $e->getCode());
        }
        $reservationsDTO = [];
        foreach ($reservations as $reservation){ 
            try{
                $Res_outils = $this->reservationRepository->findAllOutilsByReservationId($reservation->id);
            } catch (EntityNotFoundException $e) {
                throw new EntityNotFoundException($e->getEntity()." not found", $e->getEntity());
            } catch (\Exception $e) {
                throw new \Exception("probleme lors de la reception des outils.", $e->getCode());
            }
            $outilsDTO = [];
            foreach ($Res_outils as $Res_outil) {
                $outil = $Res_outil['outil'];
                $outilsDTO[] = [ 'outil' => new OutilDTO(
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
                ), 'quantite' => $panier['quantite'] ?? null];
            }
            $reservationsDTO[] = [ 'reservation' => new ReservationDTO(
                $reservation->id,
                $reservation->id_user,
                $reservation->date_debut,
                $reservation->date_fin,
                $reservation->statut,
                $reservation->cree_par ?? null,
                $reservation->cree_quand ?? null,
                $reservation->modifie_par ?? null,
                $reservation->modifie_quand ?? null,
                $outilsDTO,
            )];
        }
        return $reservationsDTO;
        
    }
}