<?php

namespace App\Controller\API;

use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/api/ville/', name: 'api_ville_')]
class VilleController extends AbstractController
{

    #[Route('All', name: 'get_all', methods: "GET")]
    public function getAll(VilleRepository $villeRepository): JsonResponse
    {
        return $this->json($villeRepository->findAll(), 200, [], ['groups' => 'read']);
    }
}
