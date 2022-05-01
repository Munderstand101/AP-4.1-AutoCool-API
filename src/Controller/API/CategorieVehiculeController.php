<?php

namespace App\Controller\API;

use App\Repository\CategorieVehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/api/categorie-vehicule/', name: 'api_ca_')]
class CategorieVehiculeController extends AbstractController
{
    #[Route('All', name: 'get_all', methods: "GET")]
    public function getAll(CategorieVehiculeRepository $categorieVehiculeRepository): JsonResponse
    {
        return $this->json($categorieVehiculeRepository->findAll(), 200, [], ['groups' => 'read']);
    }
}
