<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\ListItem;

class ListItemController extends AbstractController
{
    /**
     * @Route("/list/item/add", name="list_item_add")
     */
    public function index(Request $request)
    {
    	$task_name = $request->request->get("task_name");
    	$task_description = $request->request->get("task_description");

    	$entityManager = $this->getDoctrine()->getManager();

    	$list_item = new ListItem();
    	$list_item->setName($task_name);
    	$list_item->setDescription($task_description);
    	$list_item->setIsDone(0);

    	$entityManager->persist($list_item);

    	$entityManager->flush();

        return $this->redirectToRoute('index');
    }

    /**
   	 * @Route("/list/item/done/{id}", name="list_item_done", requirements={"id"="\d+"})
   	*/
    public function make_done($id) {
    	$entityManager = $this->getDoctrine()->getManager();

    	$list_item = $entityManager->getRepository(ListItem::class)->find($id);

    	if(!$list_item) {
    		throw $this->createNotFoundException("No list item with id " . $id);
    	}

    	$list_item->setIsDone(1);
    	$entityManager->flush();

    	return $this->redirectToRoute('index');
    }

    /**
     * @Route("/list/item/resetDone/{id}", name="list_item_resetDone", requirements={"id"="\d+"})
	*/
    public function reset_done($id) {
    	$entityManager = $this->getDoctrine()->getManager();

    	$list_item = $entityManager->getRepository(ListItem::class)->find($id);

    	if(!$list_item) {
    		throw $this->createNotFoundException("No list item with id " . $id);
    	}

    	$list_item->setIsDone(0);
    	$entityManager->flush();

    	return $this->redirectToRoute('index');
    }

    /**
     * @Route("/list/item/delete/{id}", name="list_item_delete", requirements={"id"="\d+"})
	*/
	public function delete_list_item($id) {
		$entityManager = $this->getDoctrine()->getManager();

		$list_item = $entityManager->getRepository(ListItem::class)->find($id);

		if(!$list_item) {
    		throw $this->createNotFoundException("No list item with id " . $id);
    	}

    	$entityManager->remove($list_item);
    	$entityManager->flush();

    	return $this->redirectToRoute('index');
	}
}
