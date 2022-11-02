<?php declare(strict_types = 1);

namespace App\DataFixtures;

use App\Entity\MatchEntity;
use App\Facade\Match\MatchFacade;
use App\Service\User\UserService;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

final class MatchFixture extends OrderFixture
{

	public function __construct(
		private readonly MatchFacade $matchFacade,
		private readonly UserService $userService
	) {}


	public function load(ObjectManager $manager): void
	{
		$dateNow = new \DateTime("now");
		$matches = Yaml::parseFile(__DIR__ . '/content/match.yaml');

		foreach ($matches as $match) {
			if (array_key_exists("playedAt", $match)) {
				$playedAt = (new DateTime())->setTimestamp($match["playedAt"]);
			} else {
				$playedAt = $dateNow;
			}
			$matchResult = $this->matchFacade->getMatchResult($match);

			$playerWon = $matchResult["playerWon"];
			$playerLost = $matchResult["playerLost"];
			$playerWonColor = $matchResult["playerWonColor"];

			$this->userService->setPlayerWin($playerWon);
			$this->userService->setPlayerLose($playerLost);
			$this->userService->setPlayerWinColor($playerWon, $playerWonColor);

			$newMatch = new MatchEntity();
			$newMatch->setPlayerWon($playerWon);
			$newMatch->setPlayerLost($playerLost);
			$newMatch->setPlayerWonMoves($matchResult["playerWonMoves"]);
			$newMatch->setPlayerLostMoves($matchResult["playerLostMoves"]);
			$newMatch->setPlayerWonColor($playerWonColor);
			$newMatch->setPlayerLostColor($matchResult["playerLostColor"]);
			$newMatch->setMatchDate($playedAt);

			$manager->persist($newMatch);
		}
		$manager->flush();
	}


	public function getOrder(): int
	{
		return 1;
	}

}