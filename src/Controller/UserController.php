<?php

namespace App\Controller;

use App\Entity\User;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_display_list")
     * @param PaginationInterface $paginator
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayUsersList( PaginatorInterface $paginator, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        return $this->render("list.html.twig", [
            "users" => $paginator->paginate(
                $repository->findAll(),
                $request->query->getInt('page', 1),
                10)
        ]);
    }

    /**
     * @Route("user/acvite/{id}", name="action_active_user")
     */
    public function activeUser( $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if(!$user) {
            throw $this->createNotFoundException("No users found for id $id");
        }

        $user->setActive(1);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute("user_display_list");
    }

    /**
     * @Route("/user/disabled/{id}", name="action_disabled_user")
     */
    public function disabledUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if(!$user) {
            throw $this->createNotFoundException("No users found for id $id");
        }

        $user->setActive(0);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute("user_display_list");
    }

}
