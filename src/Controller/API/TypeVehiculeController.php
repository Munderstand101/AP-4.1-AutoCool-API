<?php

namespace App\Controller\API;

use App\Repository\CategorieVehiculeRepository;
use App\Repository\TypeVehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/type/', name: 'api_type_')]
class TypeVehiculeController extends AbstractController
{
    #[Route('AllByCateg/{categ}', name: 'get_all', methods: "GET")]
    public function getAll(TypeVehiculeRepository $typeVehiculeRepository, CategorieVehiculeRepository $categorieVehiculeRepository, $categ): JsonResponse
    {
        $categorie = $categorieVehiculeRepository->findOneBy(['libelle' => $categ]);

        if (!$categorie) {
            return $this->json([
                'status' => 404,
                'message' => 'Les types ' . $categ . ' n\'existent pas',
            ], 404);
        }

        $types = $typeVehiculeRepository->findBy(['categorieVehicule' => $categorie->getId()]);

        return $this->json($types, 200, [], ['groups' => 'read']);
    }
}
