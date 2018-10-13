<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users_list", methods="GET")
     * @param Request $request
     * @return Response
     */
    public function getUsersAction(Request $request): Response {

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        /* @var $users User[] */

        $formated = [];
        foreach ($users as $user) {
            $formated[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail()
            ];
        }
        return new JsonResponse($formated);
    }

}