<?php declare(strict_types = 1);

namespace App\DataFixtures;

use App\Entity\UserEntity;
use Cassandra\Date;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Yaml\Yaml;

class UserFixture extends Fixture
{

	public function __construct(
		private readonly UserPasswordHasherInterface $hasher
	) {}


	public function load(ObjectManager $manager): void
	{
		$dateNow = new \DateTime("now");
		$users = Yaml::parseFile(__DIR__ . '/content/user.yaml');

		foreach ($users as $user) {
			if (array_key_exists("joinedAt", $user)) {

				$joinedAt = (new DateTime())->setTimestamp($user["joinedAt"]);
			} else {
				$joinedAt = $dateNow;
			}

			$newUser = new UserEntity();
			$newUser->setNickname($user['nickname']);

			$passwordHash = $this->hasher->hashPassword($newUser, $user['password']);
			$newUser->setPassword($passwordHash);
			$newUser->setJoinedAt($joinedAt);

			$manager->persist($newUser);
		}
		$manager->flush();
	}

}