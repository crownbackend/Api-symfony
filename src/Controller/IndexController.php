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
    public function getPlaces(Request $request):Response
    {

        $places = $this->getDoctrine()->getRepository(Place::class)->findAll();

        /* @var $places Place[] */

        $formatted = [];
        foreach ($places as $place) {
            $formatted[] = [
                'id' => $place->getId(),
                'name' => $place->getName(),
                'address' => $place->getAddress(),
            ];
        }

        return new JsonResponse($formatted);
    }

    /**
     * @Route("/places/{place_id}", methods="GET", name="places_one", requirements={"place_id" = "\d+"})
     * @param Request $request
     * @return Response
     */
    public function getPlaceAction(Request $request): Response
    {

        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('place_id'));
        /* @var $place Place */

        $formatted = [
            'id' => $place->getId(),
            'name' => $place->getName(),
            'address' => $place->getAddress()
        ];

        return new JsonResponse($formatted);
    }




















}