<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Publication;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Publication::class);
        
        $publications = $repo->findAll();
        
        return $this->render("home/index.html.twig", [
            'publications' => $publications,
        ]);
    }
    
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Publication::class);
        
        $publication = $repo->find($id);
        
        if (!$publication) {
            return $this->redirectToRoute('home');
        }
        
        return $this->render("show/index.html.twig", [
            'publication' => $publication,
        ]);
    }
}
