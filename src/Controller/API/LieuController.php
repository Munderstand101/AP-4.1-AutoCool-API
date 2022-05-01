<?php

namespace App\Controller\API;

use App\Repository\LieuRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/lieu/',name: 'api_lieu_')]
class LieuController extends AbstractController
{
    #[Route('AllByIdVille/{idVille}', name: 'get_all_ByIdVille', methods: "GET")]
    public function getAllByIdVille(LieuRepository $lieuRepository, VilleRepository $villeRepository, $idVille): JsonResponse
    {
        $ville = $villeRepository->findOneBy(['libelle' => $idVille]);

        if (!$ville) {
            return $this->json([
                'status' => 404,
                'message' => "Le lieu avec l'id ville : ". $idVille . " n'existe pas",
            ], 404);
        }

        $lieu = $lieuRepository->findBy(['ville' => $ville->getId()]);

        return $this->json($lieu, 200, [], ['groups' => 'read']);
    }
}
