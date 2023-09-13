<?php

namespace App\Controller;

use App\Entity\Offres;
use App\Form\OffresType;
use App\Repository\OffresRepository;
use App\Form\OffreSearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


#[Route('/offres')]
class OffresController extends AbstractController
{
    #[Route('/', name: 'app_offres_index', methods: ['GET'])]
    public function index(OffresRepository $offresRepository): Response
    {
        return $this->render('offres/index.html.twig', [
            'offres' => $offresRepository->findAll(),
        ]);
    }
    #[Route('/viewall', name: 'app_offres_viewall', methods: ['GET'])]
    public function viewall(OffresRepository $offresRepository): Response
    {
        return $this->render('offres/viewall.html.twig', [
            'offres' => $offresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_offres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offre = new Offres();
        $form = $this->createForm(OffresType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('app_offres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offres/new.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offres_show', methods: ['GET'])]
    public function show(Offres $offre): Response
    {
        return $this->render('offres/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_offres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offres $offre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffresType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offres/edit.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offres_delete', methods: ['POST'])]
    public function delete(Request $request, Offres $offre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $offre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offres_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/search', name: 'ajax_search', methods: ['GET'])]
    public function searchAction(Request $request, OffresRepository $offresRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('q');

        $offres = $em->getRepository(Offres::class)->findEntitiesByString($requestString);

        if (!$offres) {
            $result['offrename']['error'] = "NOT FOUND";
        } else {
            $result['offrename'] = $this->getRealEntities($offres);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($offres)
    {

        foreach ($offres as $offre) {
            $realEntities[$offre->getId()] = $offre->getOffrename();
        }
        return $realEntities;
    }

    #[Route('/view', name: 'app_products_View', methods: ['GET', 'POST'])]
    public function View(Request $request, OffresRepository $offresRepository): Response
    {
        $offres = $offresRepository->findAll();
        $form = $this->createForm(OffreSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchquery = $form->getData()['offrename'];
            $offres = $offresRepository->search($searchquery);
        }
        return $this->render('offres/view.html.twig', [
            'offres' => $offres,
            'form' => $form->createView()
        ]);
    }
}
