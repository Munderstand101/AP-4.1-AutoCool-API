<?php

namespace App\Controller;

use App\Repository\AbonneRepository;
use App\Repository\CategorieVehiculeRepository;
use App\Repository\UserRepository;
use App\Repository\FormuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository, AbonneRepository $abonneRepository, FormuleRepository $formuleRepository)
    {
        $this->userRepository = $userRepository;
        $this->abonneRepository = $abonneRepository;
        $this->formuleRepository = $formuleRepository;

    }

    #[Route('/api/login', name: 'api_login', methods: "POST")]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $username = $data['username'];
        $password = $data['password'];

        if (empty($username) || empty($password)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $user = $this->userRepository->findOneBy(['username' => $username]);

        if ($password == $user->getPassword() )
        {

            $data = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
            ];

            return new JsonResponse($data, Response::HTTP_OK);
        }
        else
        {
            return new JsonResponse(['status' => 'Mauvais mdp!'], Response::HTTP_CREATED);
        }
    }


    #[Route('/api/abonne', name: 'get_all_abonne', methods: "GET")]
    public function getAllAbonne(): JsonResponse
    {
        $abonnes = $this->abonneRepository->findAll();
        $data = [];

        foreach ($abonnes as $abonne) {
            $data[] = [
                'nom' => $abonne->getNom(),
                'prenom' => $abonne->getPrenom(),

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/api/formule', name: 'get_all_formule', methods: "GET")]
    public function getNameFormule(): JsonResponse
    {
        $formules = $this->formuleRepository->findAll();
        $data = [];

        foreach ($formules as $formule) {
            $data[] = [
                'id' => $formule->getId(),
                'libelle' => $formule->getLibelle(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }



    #[Route('/api/adhere/{id}', name: 'get_all_adherent', methods: "GET")]
    public function getAdherent(Request $request, int $id): JsonResponse
    {

        if(empty($id)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $adherents = $this->formuleRepository->findByAbonneWithFormuleId($id);

        $data = [];

        foreach ($adherents as $adherent) {
            $data[] = [
                'nomprenom' => array_values($adherent)[0],
                'id' => array_values($adherent)[1],
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/api/adhere/{id}/info', name: 'get_all_adherent_information', methods: "GET")]
    public function getAdherentInformation(Request $request, int $id): JsonResponse
    {

        if(empty($id)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $adherents = $this->abonneRepository->findAbonneAndDateById($id);

        $data = [];

        foreach ($adherents as $adherent) {
            $data[] = [
                "id" => array_values($adherent)[0],
                "nom" => array_values($adherent)[1],
                "prenom" => array_values($adherent)[2],
                "date_naissance" => array_values($adherent)[3],
                "rue" => array_values($adherent)[4],
                "ville" => array_values($adherent)[5],
                "code_postal" => array_values($adherent)[6],
                "tel" => array_values($adherent)[7],
                "tel_mobile" => array_values($adherent)[8],
                "email" => array_values($adherent)[9],
                "num_permis" => array_values($adherent)[10],
                "lieu_permis" => array_values($adherent)[11],
                "date_permis" => array_values($adherent)[12],
                "paiement_adhesion" => array_values($adherent)[13],
                "paiement_caution" => array_values($adherent)[14],
                "rib_fourni" => array_values($adherent)[15],
                "civilite" => array_values($adherent)[16],
                "dateAdhesion" => array_values($adherent)[17],
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
