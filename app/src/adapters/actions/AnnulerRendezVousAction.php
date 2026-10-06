<?php

declare(strict_types=1);

namespace toubilib\adapters\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use toubilib\application\ports\api\ServiceRendezVousInterface;

class AnnulerRendezVousAction
{
    public function __construct(
        private ServiceRendezVousInterface $service
    ) {
    }

    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $id = $args['id'];

        try {
            $rendezVous = $this->service->annuler($id);

            $response->getBody()->write(
                json_encode([
                    'id' => $rendezVous->id,
                    'praticienId' => $rendezVous->praticienId,
                    'patientId' => $rendezVous->patientId,
                    'dateHeureDebut' => $rendezVous->dateHeureDebut,
                    'status' => $rendezVous->status,
                    'duree' => $rendezVous->duree,
                    'dateHeureFin' => $rendezVous->dateHeureFin,
                    'dateCreation' => $rendezVous->dateCreation,
                    'motifVisite' => $rendezVous->motifVisite,
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (\RuntimeException $e) {
            $response->getBody()->write(
                json_encode([
                    'error' => $e->getMessage()
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);

        } catch (\DomainException $e) {
            $response->getBody()->write(
                json_encode([
                    'error' => $e->getMessage()
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
    }
}