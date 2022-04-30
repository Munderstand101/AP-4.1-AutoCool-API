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


#[Route('/api/main/', name: 'api_main_', methods: "GET")]
class MainController extends AbstractController
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    #[Route('/', name: 'index', methods: "GET")]
    public function index(): Response
    {
        return new Response(
            'Hakuna Matata'
        );
    }

    #[Route('login', name: 'api_login', methods: "POST")]
    public function login(UserPasswordHasherInterface $passwordHasher, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        try {

            if (empty($data)  || empty($data['username']) || empty($data['password'])){
                return $this->json(
                    [
                        'errors' => [
                            'message' => 'Le contenu de la requete est vide, ou une valeur est menquante !!'
                        ]
                    ],
                    404
                );
            }

            $user = $this->userRepository->findOneBy(['username' => $data['username']]);
            $match = $passwordHasher->isPasswordValid($user, $data['password']);

            if ($match) {
                return $this->json([
                    'status' => 201,
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'roles' => $user->getRoles(),
                ], 201);


            } else {
                return $this->json([
                    'status' => 403,
                    'message' => "Wrong password !",
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
