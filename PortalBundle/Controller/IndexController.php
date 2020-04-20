<?php

namespace PortalBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class IndexController extends Controller
{
	/**
	 *
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		$session = $request->getSession();

		return $this->render('@Portal/Index/index.html.twig', [
			'plots' => $session->get('filter_plots', null)
		]);
	}

	/**
	 *
	 * @Route("/search", name="homepage_search")
	 * @Method("POST")
	 */
	public function searchAction(Request $request)
	{
		if (
			!$request->get('query')
		) {
			throw new BadRequestHttpException('Неверные входные параметры');
		}

		$data = explode(', ', trim($request->get('query')));

		$plots = $this->get('portal.component')->findCadastralNumber($data);

		$session = $request->getSession();

		$session->set('filter_plots', $plots);

		return $this->redirectToRoute('homepage');
	}
}
