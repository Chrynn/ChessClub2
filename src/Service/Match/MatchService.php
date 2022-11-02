<?php declare(strict_types = 1);

namespace App\Service\Match;

use App\Entity\MatchEntity;
use Doctrine\ORM\EntityManagerInterface;

final class MatchService
{

	public function __construct(
		private readonly EntityManagerInterface $entityManager
	) {}


	public function getBestGameByUser(int $userId): ?MatchEntity
	{
		return $this->entityManager->createQueryBuilder()
			->select("m")
			->from(MatchEntity::class, "m")
			->where("m.playerWon = :player")
			->setParameter("player", $userId)
			->orderBy("m.playerWonMoves", "ASC")
			->setMaxResults(1)
			->getQuery()
			->getOneOrNullResult();
	}


	public function getBestMatch(): ?MatchEntity
	{
		return $this->entityManager->createQueryBuilder()
			->select("m")
			->from(MatchEntity::class, "m")
			->orderBy("m.playerWonMoves", "ASC")
			->setMaxResults(1)
			->getQuery()
			->getOneOrNullResult();
	}


	public function getWorstMatch(): ?MatchEntity
	{
		return $this->entityManager->createQueryBuilder()
			->select("m")
			->from(MatchEntity::class, "m")
			->orderBy("m.playerWonMoves", "DESC")
			->setMaxResults(1)
			->getQuery()
			->getOneOrNullResult();
	}

}