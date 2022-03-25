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

    public function __construct(UserRepository $userRepository, AbonneRepository $abonneRepository, FormuleRepository $formuleRepository, CategorieVehiculeRepository $categorieVehiculeRepository)
    {
        $this->userRepository = $userRepository;
        $this->abonneRepository = $abonneRepository;
        $this->formuleRepository = $formuleRepository;
        $this->categorieVehiculeRepository = $categorieVehiculeRepository;
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
                'libelle' => $formule->getLibelle(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }


    #[Route('/api/carcateg', name: 'get_all_categ', methods: "GET")]
    public function getAllcarcateg(): JsonResponse
    {
        $categs = $this->categorieVehiculeRepository->findAll();
        $data = [];

        foreach ($categs as $categ) {
            $data[] = [
                'nom' => $categ->getLibelle(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
