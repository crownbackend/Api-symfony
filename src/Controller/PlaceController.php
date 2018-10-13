<?php

namespace App\Controller;

use App\Entity\Place;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlaceController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/places")
     * @param Request $request
     * @return $places
     */
    public function getPlaces(Request $request)
    {

        $places = $this->getDoctrine()->getRepository(Place::class)->findAll();
        /* @var $places Place[] */

        return $places;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/places/{id}")
     * @param Request $request
     * @return $place
     */
    public function getPlaceAction(Request $request)
    {

        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('id'));
        /* @var $place Place */

        if(empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }

        return $place;
    }




















}