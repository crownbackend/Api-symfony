<?php

namespace App\Controller;

use App\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends Controller
{
    /**
     * @Route("/places", methods="GET", name="places_list")
     * @param Request $request
     * @return Response
     */
    public function getPlaces(Request $request):Response {

        $places = $this->getDoctrine()->getRepository(Place::class)->findAll();

        /* @var $places Place[] */

        $formated = [];
        foreach ($places as $place) {
            $formated[] = [
                'id' => $place->getId(),
                'name' => $place->getName(),
                'address' => $place->getAddress(),
            ];
        }

        return new JsonResponse($formated);

    }

}