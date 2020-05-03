<?php
/**
 * Created by PhpStorm.
 * User: jdries
 * Date: 02/05/2020
 * Time: 15:19
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SecurityController
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     *
     * @return JsonResponse
     */
    public function login()
    {
        return new JsonResponse(['token' => $this->getUser()->getToken()], Response::HTTP_CREATED);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function logout()
    {
        return new JsonResponse(['logout' => true], Response::HTTP_OK);
    }
}