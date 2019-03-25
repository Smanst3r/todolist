<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Entity\ListItem;

class ListItemDescriptionController extends AbstractController
{
    /**
     * @Route("/list/item/description/{id}", name="list_item_description", requirements={"id"="\d+"})
     */
    public function index($id)
    {

    	$list_item = $this->getDoctrine()->getRepository(ListItem::class)->find($id);

    	if(!$list_item) {
    		throw $this->createNotFoundException('No list_item for id ' . $id);
    	}

    	$list_item_id = $list_item->getId();
    	$list_item_name = $list_item->getName();
    	$list_item_description = $list_item->getDescription();
    	$list_item_isDone =  $list_item->getIsDone();	

        return $this->render('list_item_description/index.html.twig', [
            'controller_name' => 'ListItemDescriptionController',
            'task_id' => $list_item_id,
            'name' => $list_item_name,
            'description' => $list_item_description,
            'isDone' => $list_item_isDone
        ]);
    }
}
