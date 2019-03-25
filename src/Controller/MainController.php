<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\ListItem;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
    	$repository = $this->getDoctrine()->getRepository(ListItem::class);

    	$list_items = $repository->findAll(); 

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'list_items' => $list_items
        ]);
    }

}
