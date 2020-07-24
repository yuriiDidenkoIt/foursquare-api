<?php

namespace App\Controller;

use App\Entity\Category;
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
        return $this->render('index.html.twig', [
            'clientId' => $this->getParameter('foursquare.client_id'),
            'clientSecret' => $this->getParameter('foursquare.client_secret'),
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getFirstLevelCategories(): JsonResponse
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->getFirstLevelCategoriesFromMaterialized();

        return $this->json($categories);
    }

    /**
     * @param string $categoryId
     *
     * @return JsonResponse
     */
    public function getSubCategories(string $categoryId)
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->getSubCategoriesFromMaterialized($categoryId);

        return $this->json($categories);
    }
}