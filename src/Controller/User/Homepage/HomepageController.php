<?php declare(strict_types = 1);

namespace App\Controller\User\Homepage;

use App\Controller\User\UserController;
use App\Facade\Match\MatchFacade;
use App\Facade\User\UserFacade;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends UserController
{

	#[Route('/', name: "index")]
	public function index(MatchFacade $matchFacade): Response
	{
		$userId = $this->getUser()->getId();

		return $this->render("user/homepage/homepage.html.twig", [
			"userBest" => $matchFacade->getBestGameByUserResult($userId)
		]);
	}

}