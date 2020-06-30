<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FoursquareController
 */
class FoursquareController extends AbstractController
{

    /**
     * @return JsonResponse
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}