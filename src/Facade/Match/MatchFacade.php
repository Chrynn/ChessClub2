<?php declare(strict_types = 1);

namespace App\Facade\Match;

use App\Service\Match\MatchService;
use App\Service\User\UserService;

final class MatchFacade
{

	public function __construct(
		private readonly MatchService $matchService,
		private readonly UserService $userService
	) {}


	/**
	 * @param $match array<string, mixed>
	 * @return array<string, mixed>
	 */
	public function getMatchResult(array $match): array
	{
		$playerOne = $match["playerOne"];
		$playerTwo = $match["playerTwo"];
		$playerOneColor = $match["playerOneColor"];
		$playerTwoColor = $match["playerTwoColor"];
		$playerOneMoves = $match["playerOneMoves"];
		$playerTwoMoves = $match["playerTwoMoves"];

		if ($playerOneMoves > $playerTwoMoves) {
			$playerWon = $playerOne;
			$playerLost = $playerTwo;
			$playerWonMoves = $playerOneMoves;
			$playerLostMoves = $playerTwoMoves;
			$playerWonColor = $playerOneColor;
			$playerLostColor = $playerTwoColor;
		} else {
			$playerWon = $playerTwo;
			$playerLost = $playerOne;
			$playerWonMoves = $playerTwoMoves;
			$playerLostMoves = $playerOneMoves;
			$playerWonColor = $playerTwoColor;
			$playerLostColor = $playerOneColor;
		}

		return [
			"playerWon" => $playerWon,
			"playerLost" => $playerLost,
			"playerWonMoves" => $playerWonMoves,
			"playerLostMoves" => $playerLostMoves,
			"playerWonColor" => $playerWonColor,
			"playerLostColor" => $playerLostColor
		];
	}


	/**
	 * @return array<string, mixed>|null
	 */
	public function getBestGameByUserResult(int $userId): ?array
	{
		$bestGame = $this->matchService->getBestGameByUser($userId);
		if ($bestGame) {
			$playerWon = $bestGame->getPlayerWon();
			$playerLost = $bestGame->getPlayerLost();

			return [
				"playerWon" => $this->userService->getUserById($playerWon),
				"playerLost" => $this->userService->getUserById($playerLost),
				"playerWonMoves" => $bestGame->getPlayerWonMoves(),
				"playerLostMoves" => $bestGame->getPlayerLostMoves(),
				"playerWonColor" => $bestGame->getPlayerWonColor(),
				"playerLostColor" => $bestGame->getPlayerLostColor()
			];
		} else {

			return NULL;
		}
	}


	/**
	 * @return array<string, mixed>|null
	 */
	public function getBestMatchResult(): ?array
	{
		$matchEntity = $this->matchService->getBestMatch();
		if ($matchEntity) {
			$playerWon = $matchEntity->getPlayerWon();
			$playerLost = $matchEntity->getPlayerLost();

			return [
				"playerWon" => $this->userService->getUserById($playerWon),
				"playerLost" => $this->userService->getUserById($playerLost),
				"playerWonMoves" => $matchEntity->getPlayerWonMoves(),
				"playerLostMoves" => $matchEntity->getPlayerLostMoves(),
				"date" => $matchEntity->getMatchDate()
			];
		} else {

			return NULL;
		}
	}


	/**
	 * @return array<string, mixed>|NULL
	 */
	public function getWorstMatchResult(): ?array
	{
		$matchEntity = $this->matchService->getWorstMatch();
		if ($matchEntity) {
			$playerWon = $matchEntity->getPlayerWon();
			$playerLost = $matchEntity->getPlayerLost();

			return [
				"playerWon" => $this->userService->getUserById($playerWon),
				"playerLost" => $this->userService->getUserById($playerLost),
				"playerWonMoves" => $matchEntity->getPlayerWonMoves(),
				"playerLostMoves" => $matchEntity->getPlayerLostMoves(),
				"date" => $matchEntity->getMatchDate()
			];
		} else {

			return NULL;
		}
	}


	/**
	 * @return array<string, mixed>|NULL
	 */
	public function getTopPlayersResult(): ?array
	{
		$topPlayers = $this->userService->getUsersByWin(10);
		if (!empty($topPlayers)) {
			$topMatchesResult = [];

			foreach ($topPlayers as $topPlayer) {

				if ($topPlayer->getWinCount() !== NULL) {
					$topMatchesResult[] = [
						"wins" => $topPlayer->getWinCount(),
						"player" => $topPlayer->getNickname()
					];
				} else {
					break;
				}
			}
			array_unshift($topMatchesResult, "");

			return $topMatchesResult;
		} else {

			return NULL;
		}
	}

}