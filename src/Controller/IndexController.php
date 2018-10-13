<?php

namespace App\Controller;

use App\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends Controller
{
    /**
     * @Route("/places", methods="GET", name="places_list")
     * @return Response
     */
    public function getPlaces():Response {

        return new JsonResponse([
            new Place('Tour Eiffel', '5 Avenue Anatole France, 75007 Paris'),
            new Place("Mont-Saint-Michel", "50170 Le Mont-Saint-Michel"),
            new Place("Château de Versailles", "Place d'Armes, 78000 Versailles"),
        ]);
    }

}