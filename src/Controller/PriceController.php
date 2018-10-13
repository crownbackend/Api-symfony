<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Price;
use App\Form\PriceType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends Controller
{
    /**
     * @Rest\view()
     * @Rest\Get("/places/{id}/prices")
     * @param Request $request
     * @return
     */
    public function getPricesAction(Request $request)
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('id'));

        /* @var $place Place */

        if (empty($place)) {
            return $this->placeNotFound();
        }

        return $place->getPrices();
    }

    /**
     * @Rest\view(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places/{id}/prices")
     * @param Request $request
     * @return
     */
    public function postPricesAction(Request $request)
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('id'));

        /* @var $place Place */

        if (empty($place)){
            return $this->placeNotFound();
        }

        $price = new Price();
        $price->setPlace($place);
        $form = $this->createForm(PriceType::class, $price);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($price);
            $em->flush();
            return $price;
        } else {
            return $form;
        }

    }

    private function placeNotFound()
    {
        return View::create(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
    }

}