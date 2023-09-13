<?php

namespace App\Controller;

use App\Entity\Stage;

use App\Entity\Registration;
use App\Form\RegistrationType;
use App\Form\StageType;
use App\Repository\RegistrationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/regist')]
class RegistController extends AbstractController
{
    #[Route('/', name: 'app_regist_index', methods: ['GET'])]
    public function index(RegistrationRepository $registrationRepository,): Response
    {
        return $this->render('regist/index.html.twig', [
            'registrations' => $registrationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_regist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $registration = new Registration();
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($registration);
            $entityManager->flush();

            return $this->redirectToRoute('app_regist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('regist/new.html.twig', [
            'registration' => $registration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_regist_show', methods: ['GET'])]
    public function show(Registration $registration): Response
    {
        return $this->render('regist/show.html.twig', [
            'registration' => $registration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_regist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Registration $registration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_regist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('regist/edit.html.twig', [
            'registration' => $registration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_regist_delete', methods: ['POST'])]
    public function delete(Request $request, Registration $registration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $registration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($registration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_regist_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/new/{id}', name: 'app_stage_toregister', methods: ['GET', 'POST'])]
    public function ToDonate(Request $request, Registration  $registration, RegistrationRepository $RegistrationRepository, Stage $stage): Response
    {

        $stage = new Stage();
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $RegistrationRepository->save($stage, true);

            return $this->redirectToRoute('app_regist_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('regist/new.html.twig', [
            'registration' => $registration,
            'form' => $form,
            'stage' => $stage,
        ]);
    }
}
