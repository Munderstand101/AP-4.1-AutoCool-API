<?php

namespace App\Controller\Backoffice;

use App\Entity\Formule;
use App\Form\FormuleType;
use App\Repository\FormuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backofice/formule')]
class FormuleController extends AbstractController
{
    #[Route('/', name: 'formule_index', methods: ['GET'])]
    public function index(FormuleRepository $formuleRepository): Response
    {
        return $this->render('formule/index.html.twig', [
            'formules' => $formuleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'formule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formule = new Formule();
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formule);
            $entityManager->flush();

            return $this->redirectToRoute('formule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formule/new.html.twig', [
            'formule' => $formule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'formule_show', methods: ['GET'])]
    public function show(Formule $formule): Response
    {
        return $this->render('formule/show.html.twig', [
            'formule' => $formule,
        ]);
    }

    #[Route('/{id}/edit', name: 'formule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formule $formule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('formule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formule/edit.html.twig', [
            'formule' => $formule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'formule_delete', methods: ['POST'])]
    public function delete(Request $request, Formule $formule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formule_index', [], Response::HTTP_SEE_OTHER);
    }
}
