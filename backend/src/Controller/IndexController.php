<?php
/**
 * Created by PhpStorm.
 * User: jdries
 * Date: 02/05/2020
 * Time: 11:15
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function privateAction()
    {
        $date = new \DateTime();
        $data['activities'] = [
            [
                'time' => $date->format('Y-m-d'),
                "id" => 1,
                "title" => "Vous avez demandé la résiliation de votre assurance RC",
                "description" => "Pro Raincoat."
            ],
            [
                'time' => $date->format('Y-m-d'),
                "id" => 2,
                "title" => "Vous avez demandé la résiliation de votre assurance RC",
                "description" => "Pro Raincoat."
            ],
            [
                'time' => $date->format('Y-m-d'),
                "id" => 3,
                "title" => "Vous avez demandé la résiliation de votre assurance RC",
                "description" => "Pro Raincoat."
            ],
        ];
        $data['userInfos'] = [
            'idCompany' => 185298248744,
            'company' => 'EasyBlue',
            'address' => '341 Chasity Overpass, runofsson Walks',
            'cp' => 33282,
            'city' => 'Johnsmouth',
            'country' => 'France',
        ];

        return new JsonResponse($data);
    }
}