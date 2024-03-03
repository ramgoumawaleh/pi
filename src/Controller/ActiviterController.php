<?php

namespace App\Controller;

use App\Entity\Activiter;
use App\Form\ActiviterType;
use App\Repository\ActiviterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActiviterController extends AbstractController
{
    /**
     * This controller display all activiter
     *
     * @param ActiviterRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/activiter', name: 'activiter.index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(
        ActiviterRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $activiters = $paginator->paginate(
            $repository->findBy(['user' => $this->getUser()]),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/activiter/index.html.twig', [
            'activiters' => $activiters
        ]);
    }

    /**
     * This controller show a form which create an activiter
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/activiter/creation', 'activiter.new')]
    #[IsGranted('ROLE_USER')]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $activiter = new Activiter();
        $form = $this->createForm(ActiviterType::class, $activiter);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $activiter = $form->getData();
            $activiter->setUser($this->getUser());

            $manager->persist($activiter);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre activiter a été créé avec succès !'
            );

            return $this->redirectToRoute('activiter.index');
        }

        return $this->render('pages/activiter/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This controller allow us to edit an activiter
     *
     * @param Activiter $activiter
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Security("is_granted('ROLE_USER') and user === activiter.getUser()")]
    #[Route('/activiter/edition/{id}', 'activiter.edit', methods: ['GET', 'POST'])]
    public function edit(
        Activiter $activiter,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(ActiviterType::class, $activiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activiter = $form->getData();

            $manager->persist($activiter);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre activiter a été modifié avec succès !'
            );

            return $this->redirectToRoute('activiter.index');
        }

        return $this->render('pages/activiter/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This controller allows us to delete an activiter
     *
     * @param EntityManagerInterface $manager
     * @param Activiter $activiter
     * @return Response
     */
    #[Route('/activiter/suppression/{id}', 'activiter.delete', methods: ['GET'])]
    #[Security("is_granted('ROLE_USER') and user === activiter.getUser()")]
    public function delete(
        EntityManagerInterface $manager,
        Activiter $activiter
    ): Response {
        $manager->remove($activiter);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre activiter a été supprimé avec succès !'
        );

        return $this->redirectToRoute('activiter.index');
    }
}