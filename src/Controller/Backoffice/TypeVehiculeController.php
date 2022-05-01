<?php

namespace App\Controller\Backoffice;

use App\Entity\TypeVehicule;
use App\Form\TypeVehiculeType;
use App\Repository\TypeVehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/type-vehicule')]
class TypeVehiculeController extends AbstractController
{
    #[Route('/', name: 'type_vehicule_index', methods: ['GET'])]
    public function index(TypeVehiculeRepository $typeVehiculeRepository): Response
    {
        return $this->render('type_vehicule/index.html.twig', [
            'type_vehicules' => $typeVehiculeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'type_vehicule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeVehicule = new TypeVehicule();
        $form = $this->createForm(TypeVehiculeType::class, $typeVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeVehicule);
            $entityManager->flush();

            return $this->redirectToRoute('type_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_vehicule/new.html.twig', [
            'type_vehicule' => $typeVehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'type_vehicule_show', methods: ['GET'])]
    public function show(TypeVehicule $typeVehicule): Response
    {
        return $this->render('type_vehicule/show.html.twig', [
            'type_vehicule' => $typeVehicule,
        ]);
    }

    #[Route('/{id}/edit', name: 'type_vehicule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeVehicule $typeVehicule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeVehiculeType::class, $typeVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('type_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_vehicule/edit.html.twig', [
            'type_vehicule' => $typeVehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'type_vehicule_delete', methods: ['POST'])]
    public function delete(Request $request, TypeVehicule $typeVehicule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeVehicule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeVehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_vehicule_index', [], Response::HTTP_SEE_OTHER);
    }
}
