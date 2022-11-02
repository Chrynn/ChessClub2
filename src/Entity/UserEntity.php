<?php declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class UserEntity implements UserInterface, PasswordAuthenticatedUserInterface
{

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $id;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected string $nickname;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected string $password;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected ?string $forename;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected ?string $surname;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected ?string $number;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $winCount;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $loseCount;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $winsAsWhite;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected ?int $winsAsBlack;

	/**
	 * @ORM\Column(type="datetime", nullable=false)
	 */
	protected \DateTime $joinedAt;


	public function setId(int $id): void
	{
		$this->id = $id;
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getNickname(): string
	{
		return $this->nickname;
	}


	public function setNickname(string $nickname): void
	{
		$this->nickname = $nickname;
	}


	public function getPassword(): string
	{
		return $this->password;
	}


	public function setPassword(string $password): void
	{
		$this->password = $password;
	}


	public function getForename(): ?string
	{
		return $this->forename;
	}


	public function setForename(?string $forename): void
	{
		$this->forename = $forename;
	}


	public function getSurname(): ?string
	{
		return $this->surname;
	}


	public function setSurname(?string $surname): void
	{
		$this->surname = $surname;
	}


	public function getNumber(): ?string
	{
		return $this->number;
	}


	public function setNumber(?string $number): void
	{
		$this->number = $number;
	}


	public function getWinCount(): ?int
	{
		return $this->winCount;
	}


	public function setWinCount(?int $winCount): void
	{
		$this->winCount = $winCount;
	}


	public function getLoseCount(): ?int
	{
		return $this->loseCount;
	}


	public function setLoseCount(?int $loseCount): void
	{
		$this->loseCount = $loseCount;
	}


	public function getWinsAsWhite(): ?int
	{
		return $this->winsAsWhite;
	}


	public function setWinsAsWhite(?int $winsAsWhite): void
	{
		$this->winsAsWhite = $winsAsWhite;
	}


	public function getWinsAsBlack(): ?int
	{
		return $this->winsAsBlack;
	}


	public function setWinsAsBlack(?int $winsAsBlack): void
	{
		$this->winsAsBlack = $winsAsBlack;
	}


	public function setJoinedAt(\DateTime $joinedAt): void
	{
		$this->joinedAt = $joinedAt;
	}


	public function getJoinedAt(): \DateTime
	{
		return $this->joinedAt;
	}

	public function getRoles(): array
	{
		return [];
	}


	public function eraseCredentials()
	{}


	public function getUserIdentifier(): string
	{
		return $this->getNickname();
	}
}