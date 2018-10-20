<?php

namespace App\Controller;

use App\Entity\Place;
use App\Form\PlaceType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PlaceController extends Controller
{

    private function placeNotFound()
    {
        return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\View(serializerGroups={"place"})
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
     * @Rest\View(serializerGroups={"place"})
     * @Rest\Get("/places/{id}")
     * @param Request $request
     * @return $place
     */
    public function getPlaceAction(Request $request)
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('id'));
        /* @var $place Place */

        if(empty($place)) {
            return $this->placeNotFound();
        }
        return $place;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"place"})
     * @Rest\Post("/places")
     * @param Request $request
     * @return
     */
    public function postPlacesAction(Request $request)
    {
        $place = new Place();
        $form = $this->createForm(PlaceType::class, $place);

        $form->submit($request->request->all());

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();
            return $place;
        } else {
            return $form;
        }

    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"place"})
     * @Rest\Delete("/places/{id}")
     * @param Request $request
     */
    public function removePlaceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $place = $em->getRepository(Place::class)->find($request->get('id'));
        /* @var $place Place */
        if(!$place) {
            return;
        }

        foreach ($place->getPrices() as $price) {
            $em->remove($price);
        }
        $em->remove($place);
        $em->flush();
    }

    /**
     * @Rest\View(serializerGroups={"place"})
     * @Rest\Put("/places/{id}")
     * @param Request $request
     */
    public function putPlaceAction(Request $request)
    {
        return $this->updateplace($request, true);

    }

    /**
     * @Rest\View(serializerGroups={"place"})
     * @Rest\Patch("/places/{id}")
     * @param Request $request
     */
    public function patchPlaceAction(Request $request)
    {
        return $this->updateplace($request, false);
    }

    /* refactoring */
    public function updateplace(Request $request, $clearMissing)
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('id'));

        if (empty($place)) {
            return $this->placeNotFound();
        }

        $form = $this->createForm(PlaceType::class, $place);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->merge($place);
            $em->flush();
            return $place;
        } else {
            return $form;
        }

    }




















}