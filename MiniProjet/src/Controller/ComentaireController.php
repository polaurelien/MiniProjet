<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Crypto;
use App\Form\CryptoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentaireType;
use App\Entity\Commentaire;
use App\Entity\User;

class ComentaireController extends AbstractController
{
    /**
     * @Route("/comentaire", name="app_comentaire")
     */
    public function index(): Response
    {
        return $this->render('comentaire/index.html.twig', [
            'controller_name' => 'ComentaireController',
        ]);
    }

    /**
     *
     * @Route("/ajoutCom/{id}" , name="commentaire.ajout")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function AjoutCommentaire(Request $request, EntityManagerInterface $em, $id) : Response
    {
        $commentaire = new Commentaire();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('Username' => $this->getUser()->getUsername()));
        //dd($user);
        $crypto = $this->getDoctrine()->getRepository(Crypto::class)->findOneBy(array('id'=>$id));
        $commentaire->setAuteur($user);
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { $em->persist($commentaire);
            $user->addCommentaire($commentaire);
            $crypto->addCommentaire($commentaire);

            $em->flush();
            return $this->redirectToRoute('crypto.list');
        }
        return $this->render('comentaire/index.html.twig', [
            'form' => $form->createView(), ]);



    }

    /**
     *
     * @Route("commentaire/{id}/delete", name="commentaire.delete")
     * @param Request $request
     * @param Commentaire $com
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Commentaire $com, EntityManagerInterface $em) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute('crypto.list');
    }


}
