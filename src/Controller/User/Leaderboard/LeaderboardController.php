<?php declare(strict_types = 1);

namespace App\Controller\User\Leaderboard;

use App\Controller\User\UserController;
use App\Facade\Match\MatchFacade;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeaderboardController extends UserController
{

	#[Route('/leaderboard', name: "User:Leaderboard")]
	public function index(MatchFacade $matchFacade): Response
	{
		return $this->render("user/leaderboard/leaderboard.html.twig", [
			"bestMatch" => $matchFacade->getBestMatchResult(),
			"worstMatch" => $matchFacade->getWorstMatchResult(),
			"topPlayers" => $matchFacade->getTopPlayersResult()
		]);
	}

}