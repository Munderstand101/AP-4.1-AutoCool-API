<?php

namespace App\Controller\API;

use App\Repository\AbonneRepository;
use App\Repository\CategorieVehiculeRepository;
use App\Repository\LieuRepository;
use App\Repository\TypeVehiculeRepository;
use App\Repository\UserRepository;
use App\Repository\FormuleRepository;
use App\Repository\VehiculeRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/api/main/', name: 'api_main_')]
class MainController extends AbstractController
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('', name: 'index', methods: "GET")]
    public function index(): Response
    {
        return $this->json([
            'status' => 200,
            'message' => "Hakuna Matata",
        ], 200);
    }

    #[Route('login', name: 'login', methods: "POST")]
    public function login(UserPasswordHasherInterface $passwordHasher, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        try {

            if (empty($data)  || empty($data['username']) || empty($data['password'])){
                return $this->json([
                    'status' => 403,
                    'message' => "Le contenu de la requete est vide, ou une valeur est menquante !",
                ], 403);
            }

            $user = $this->userRepository->findOneBy(['username' => $data['username']]);

            if (!$user) {
                return $this->json([
                    'status' => 403,
                    'message' => "Mauvais nom d'utilisateur !",
                ], 403);
            }

            $match = $passwordHasher->isPasswordValid($user, $data['password']);

            if ($match) {
                return $this->json([
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'roles' => $user->getRoles(),
                ], 201);
            } else {
                return $this->json([
                    'status' => 403,
                    'message' => "Mauvais mot de passe !",
                ], 403);
            }
        }
        catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

}
