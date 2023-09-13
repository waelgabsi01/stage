<?php

namespace App\Controller;



use Twilio\Rest\Client;
use App\Entity\Stage;
use App\Form\StageType;
use App\Repository\StageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




#[Route('/stage')]
class StageController extends AbstractController
{
    #[Route('/', name: 'app_stage_index', methods: ['GET'])]
    public function index(StageRepository $stageRepository): Response
    {
        return $this->render('stage/index.html.twig', [
            'stages' => $stageRepository->findAll(),
        ]);
    }
    #[Route('/viewall', name: 'app_stage_viewall', methods: ['GET'])]
    public function viewall(StageRepository $stageRepository): Response
    {
        return $this->render('stage/viewall.html.twig', [
            'stages' => $stageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, StageRepository $stageRepository): Response
    {
        $stage = new Stage();
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the $stage entity using the EntityManager
            $entityManager->persist($stage);
            $entityManager->flush();

            // The rest of your code, including Twilio logic
            $sid = 'AC1d3698dee78adbebcc6f77f1fb18346c';
            $token = 'ed2bc0fcee11a4cb95dc365f4986dd60';
            $from = '+15076783752';
            $twilio = new Client($sid, $token);

            // Create and send your Twilio message here

            return $this->redirectToRoute('app_stage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stage/new.html.twig', [
            'stage' => $stage,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_stage_show', methods: ['GET'])]
    public function show(Stage $stage): Response
    {
        return $this->render('stage/show.html.twig', [
            'stage' => $stage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_stage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stage $stage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_stage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stage/edit.html.twig', [
            'stage' => $stage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stage_delete', methods: ['POST'])]
    public function delete(Request $request, Stage $stage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $stage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($stage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_stage_index', [], Response::HTTP_SEE_OTHER);
    }
}
