<?php

namespace App\Controller;

use App\Form\CryptoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Crypto;

class CryptoController extends AbstractController
{
    /**
     *
     * @Route("/crypto", name="crypto.index")
     */
    public function index(): Response
    {
        return $this->render('crypto/index.html.twig', [
            'controller_name' => 'CryptoController',
        ]);
    }

    /**
     * Créer une nouvelle crypto.
     * @Route("/crypto/create", name="crypto.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $crypto = new Crypto();
        $form = $this->createForm(CryptoType::class, $crypto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($crypto);
            $em->flush();
            return $this->redirectToRoute('crypto.index');
        }
        return $this->render('crypto/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     *
     * @Route("/crypto/list", name="crypto.list")
     */
    public function list(EntityManagerInterface $em) : Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getRepository(Crypto::class);
        $liste = $em->findAll();
        //dd($liste);
        if($user->isAdmin())
        {
            return $this->render('crypto/list.html.twig', [
                'liste' => $liste,
            ]);
        }
        else
        {
            return $this->render('crypto/listSec.html.twig', [
                'liste' => $liste,
            ]);
        }
    }

    /**
     * Éditer une crypto.
     * @Route("crypto/{id}/edit", name="crypto.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Crypto $crypto, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(CryptoType::class, $crypto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('crypto.list');
        }
        return $this->render('crypto/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer une crypto.
     * @Route("crypto/{id}/delete", name="crypto.delete")
     * @param Request $request
     * @param Crypto $crypto
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Crypto $crypto, EntityManagerInterface $em) : Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($crypto);
        $em->flush();
        return $this->redirectToRoute('crypto.list');
    }
}
