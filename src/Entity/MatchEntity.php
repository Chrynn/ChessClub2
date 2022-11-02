<?php declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`match`")
 */
class MatchEntity
{

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $id;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $playerWon;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $playerLost;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $playerWonMoves;

	/**
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $playerLostMoves;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected string $playerWonColor;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected string $playerLostColor;

	/**
	 * @ORM\Column(type="datetime", nullable=false)
	 */
	protected \DateTime $playedAt;


	public function getId(): int
	{
		return $this->id;
	}


	public function getPlayerWon(): int
	{
		return $this->playerWon;
	}


	public function setPlayerWon(int $playerWon): void
	{
		$this->playerWon = $playerWon;
	}


	public function getPlayerLost(): int
	{
		return $this->playerLost;
	}


	public function setPlayerLost(int $playerLost): void
	{
		$this->playerLost = $playerLost;
	}


	public function getPlayerWonMoves(): int
	{
		return $this->playerWonMoves;
	}


	public function setPlayerWonMoves(int $playerWonMoves): void
	{
		$this->playerWonMoves = $playerWonMoves;
	}


	public function getPlayerLostMoves(): int
	{
		return $this->playerLostMoves;
	}


	public function setPlayerLostMoves(int $playerLostMoves): void
	{
		$this->playerLostMoves = $playerLostMoves;
	}


	public function getPlayerWonColor(): string
	{
		return $this->playerWonColor;
	}


	public function setPlayerWonColor(string $playerWonColor): void
	{
		$this->playerWonColor = $playerWonColor;
	}


	public function getPlayerLostColor(): string
	{
		return $this->playerLostColor;
	}


	public function setPlayerLostColor(string $playerLostColor): void
	{
		$this->playerLostColor = $playerLostColor;
	}


	public function getMatchDate(): \DateTime
	{
		return $this->playedAt;
	}


	public function setMatchDate(\DateTime $playedAt): void
	{
		$this->playedAt = $playedAt;
	}

}