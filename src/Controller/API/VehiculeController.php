<?php

namespace App\Controller\API;

use App\Entity\Vehicule;
use App\Repository\CategorieVehiculeRepository;
use App\Repository\LieuRepository;
use App\Repository\TypeVehiculeRepository;
use App\Repository\VehiculeRepository;
use App\Repository\VilleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/vehicule/',name: 'api_vehicule_')]
class VehiculeController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine){}

    #[Route('/', name: 'index', methods: "GET")]
    public function index(VehiculeRepository $vehiculeRepository): JsonResponse
    {
        return $this->json($vehiculeRepository->findAll(), 200, [], ['groups' => 'read']);
    }

    #[Route('new', name: 'add', methods: ['POST'])]
    public function newVehicule(TypeVehiculeRepository $typeVehiculeRepository, LieuRepository $lieuRepository, Request $request, ValidatorInterface $validator)
    {
        $jsonData = $request->getContent();

        try {

            $data = json_decode($jsonData, true);
            if (empty($data)
                || empty($data['libelle'])
                || empty($data['kilometrage'])
                || empty($data['niveau_essence'])
                || empty($data['nb_place'])
                || empty($data['estAutomatique'])
                || empty($data['typeVehicule'])
                || empty($data['lieu'])) {

                return $this->json([
                    'status' => 403,
                    'message' => "Le contenu de la requete est vide, ou une valeur est menquante !",
                ], 403);
            }

            $car = new Vehicule();
            $car->setLibelle($data['libelle']);
            $car->setKilometrage($data['kilometrage']);
            $car->setNiveauEssence($data['niveau_essence']);
            $car->setNbPlace($data['nb_place']);
            $car->setEstAutomatique($data['estAutomatique']);
            $car->setTypeVehicule($typeVehiculeRepository->findOneBy(['libelle' => $data['typeVehicule']]));
            $car->setLieu($lieuRepository->findOneBy(['libelle' => $data['lieu']]));


            $errors = $validator->validate($car);

            if(count($errors)>0)
            {
                return $this->json($errors, 400);
            }

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->json($car, 201, [], ['groups' => 'read']);

        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }

    }

    #[Route('edit/{id}', name: 'update', methods: ['POST', 'GET'])]
    public function updateVehicule(int $id, TypeVehiculeRepository $typeVehiculeRepository, LieuRepository $lieuRepository, VehiculeRepository $vehiculeRepository, Request $request, SerializerInterface $serialiser, ValidatorInterface $validator)
    {
        $jsonData = $request->getContent();

        $vehicule = $vehiculeRepository->find($id);

        if (!$vehicule) {
            return $this->json([
                'status' => 404,
                'message' => 'Le vehicule ' . $id . ' n\'existe pas',
            ], 404);
        }

//        $serialiser->deserialize($jsonData, Vehicule::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $vehicule]); //marche pas :(

        $data = json_decode($jsonData, true);
        if (empty($data)
            || empty($data['libelle'])
            || empty($data['kilometrage'])
            || empty($data['niveau_essence'])
            || empty($data['nb_place'])
            || empty($data['estAutomatique'])
            || empty($data['typeVehicule'])
            || empty($data['lieu'])) {

            return $this->json([
                'status' => 403,
                'message' => "Le contenu de la requete est vide, ou une valeur est menquante !",
            ], 403);
        }

        $vehicule->setLibelle($data['libelle']);
        $vehicule->setKilometrage($data['kilometrage']);
        $vehicule->setNiveauEssence($data['niveau_essence']);
        $vehicule->setNbPlace($data['nb_place']);
        $vehicule->setEstAutomatique($data['estAutomatique']);
        $vehicule->setTypeVehicule($typeVehiculeRepository->findOneBy(['libelle' => $data['typeVehicule']]));
        $vehicule->setLieu($lieuRepository->findOneBy(['libelle' => $data['lieu']]));
        $errors = $validator->validate($vehicule);

        if(count($errors)>0)
        {
            return $this->json($errors, 400);
        }

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($vehicule);
        $entityManager->flush();


        return $this->json([
            'id' => $id,
            'message' => 'Le vehicule ' . $vehicule->getLibelle() . ' a bien été mise à jour'
        ]);

    }

    #[Route('delete/{id}', name: 'delete', methods: ['DELETE', 'GET'])]
    public function deleteVehicule(int $id, VehiculeRepository $vehiculeRepository)
    {
        $car = $vehiculeRepository->find($id);

        if (!$car) {
            return $this->json([
                'status' => 404,
                'message' => 'Le vehicule' . $id . ' n\'existe pas',
            ], 404);
        }

        $entityManager = $this->doctrine->getManager();
        $entityManager->remove($car);
        $entityManager->flush();

        return $this->json([
            'id' => $id,
            'message' => 'Le vehicule ' . $id . ' a bien été supprimée'
        ]);
    }

    #[Route('OneById/{id}', name: 'get_one_ById', methods: "GET")]
    public function getOneByID(VehiculeRepository $vehiculeRepository, $id): JsonResponse
    {
        $vehicule = $vehiculeRepository->findVehicleLieuVilleById($id);

        if (!$vehicule) {
            return $this->json([
                'status' => 404,
                'message' => 'Le vehicule' . $id . ' n\'existe pas',
            ], 404);
        }

        return $this->json($vehicule, 200, [], ['groups' => 'read']);
    }

    #[Route('AllByCateg/{categ}', name: 'get_all_ByCateg', methods: "GET")]
    public function getAllByCateg(TypeVehiculeRepository $typeVehiculeRepository, CategorieVehiculeRepository $categorieVehiculeRepository, LieuRepository $lieuRepository, VilleRepository $villeRepository, VehiculeRepository $vehiculeRepository, NormalizerInterface $normalizer, $categ): JsonResponse
    {
        $categorie = $categorieVehiculeRepository->findOneBy(['libelle' => $categ]);
        if (!$categorie) {
            return $this->json([
                'status' => 404,
                'message' => 'Aucun vehicule trouver avec la categorie : ' . $categ,
            ], 404);
        }

        $type = $typeVehiculeRepository->findOneBy(['categorieVehicule' => $categorie->getId()]);
        $vehicules = $vehiculeRepository->findBy(['typeVehicule' => $type->getId()]);


        return $this->json($vehicules, 200, [], ['groups' => 'read']);
    }

    #[Route('AllVehiculeVilleLieuByCate/{categ}', name: 'get_vehicules_ville_lieu_ByCateg', methods: "GET")]
    public function getAllVehiculeVilleLieuByCate(TypeVehiculeRepository $typeVehiculeRepository, CategorieVehiculeRepository $categorieVehiculeRepository, LieuRepository $lieuRepository, VilleRepository $villeRepository, VehiculeRepository $vehiculeRepository, NormalizerInterface $normalizer, $categ): JsonResponse
    {

        $vehicules = $vehiculeRepository->findVehicleLieuVilleByCateg($categ);

        if (!$vehicules) {
            return $this->json([
                'status' => 404,
                'message' => 'Les vehicules de categorie' . $categ . ' n\'ont pas ete trouver',
            ], 404);
        }

        return $this->json($vehicules, 200, [], ['groups' => 'read']);
    }


}
