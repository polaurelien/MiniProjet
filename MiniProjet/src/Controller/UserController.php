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

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    /**
     * @Route("/user/{id}/favoris", name="user.favoris")
     * @param Request $request
     * @param EntityManagerInterface $em
     */
    public function ajoutFav(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $em3 = $this->getDoctrine()->getRepository(Crypto::class);
        $cryp = $em3->findOneBy(array('id'=>$id));
        //dd($cryp);
        $user->addCrypto($cryp);
        $em->flush();
        $em2 = $this->getDoctrine()->getRepository(Crypto::class);
        $liste = $em2->findAll();
        //dd($user);
        if($user->getAdmin())
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
     * @Route("/user/favoris_list", name="user.favoris_liste")
     */
    public function listFav(): Response
    {
        $user = $this->getUser();
        $fav = $user->getCryptos();
        return $this->render('user/fav.html.twig', [
            'fav' => $fav,
        ]);


    }

    /**
     * Modification du style.
     * @Route("/user/ambiance/{amb}", name="user.ambiance") * @return Response
     */
    public function theme($amb, Request $request) : Response
    {
        $amb == 'cerulean' ? $amb = 'solar': $amb = 'cerulean';
        setcookie('amb', $amb, time()+259200, '/', 'localhost', true); //dure 72h
        return $this->redirect($request->headers->get('referer'));
    }
}
