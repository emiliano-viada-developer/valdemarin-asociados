<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\BuildingSearcherType;
use AppBundle\Form\Type\AuctionSearcherType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // Get featured properties
        $em = $this->getDoctrine()->getManager();
		$featured = $em->getRepository('AppBundle:Building')->getFeatured();

		// Searcher forms
		$buildingSearcherForm = $this->createForm(new BuildingSearcherType());
		$auctionSearcherForm = $this->createForm(new AuctionSearcherType());

        return $this->render('default/index.html.twig', array(
        	'featured' => $featured,
        	'buildingSearcherForm' => $buildingSearcherForm->createView(),
        	'auctionSearcherForm' => $auctionSearcherForm->createView()
    	));
    }

    /**
     * @Route("/inmuebles/buscar/", name="building_search")
     */
    public function buildingSearchAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$buildingSearcher = $request->request->get('building_searcher');
		$results = $em->getRepository('AppBundle:Building')->search($buildingSearcher);

		// Sidebar form
		$formRoute = $this->get('router')->generate('building_search');
		$form = $this->createForm(new BuildingSearcherType());
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);
		}

    	return $this->render('search/listing.html.twig', array(
    		'type' => 'Inmuebles',
    		'results' => $results,
    		'form_route' => $formRoute,
    		'form' => $form->createView()
		));
    }

    /**
     * @Route("/subastas/buscar/", name="auction_search")
     */
    public function auctionSearchAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$auctionSearcher = $request->request->get('auction_searcher');
		$results = $em->getRepository('AppBundle:Auction')->search($auctionSearcher);

		// Sidebar form
		$formRoute = $this->get('router')->generate('auction_search');
		$form = $this->createForm(new AuctionSearcherType());
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);
		}

    	return $this->render('search/listing.html.twig', array(
    		'type' => 'Subastas',
    		'results' => $results,
    		'form_route' => $formRoute,
    		'form' => $form->createView()
		));
    }
}
