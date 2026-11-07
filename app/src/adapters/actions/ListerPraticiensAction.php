<?php

declare(strict_types=1);

namespace toubilib\adapters\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use toubilib\application\ports\api\ServicePraticienInterface;

class ListerPraticiensAction
{
    public function __construct(
        private ServicePraticienInterface $service
    ) {}

    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $praticiens = $this->service->lister();

        $data = array_map(
            fn ($praticien) => get_object_vars($praticien),
            $praticiens
        );

        $response->getBody()->write(
            json_encode($data, JSON_THROW_ON_ERROR)
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
