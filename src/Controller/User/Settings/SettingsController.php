<?php declare(strict_types = 1);

namespace App\Controller\User\Settings;

use App\Controller\User\UserController;
use App\Entity\UserEntity;
use App\Service\User\UserService;
use App\User\Settings\PasswordForm\PasswordForm;
use App\User\Settings\SettingsForm\SettingsForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class SettingsController extends UserController
{

	#[Route('/settings', name: "User:Settings")]
	public function index(UserService $userService, Request $request): Response
	{
		$settingsForm = $this->createForm(SettingsForm::class);
		$passwordForm = $this->createForm(PasswordForm::class);

		$settingsForm->handleRequest($request);
		$loggedUser = $this->getUser();

		$settingsForm->get("nickname")->setData($loggedUser->getNickname());
		$settingsForm->get("forename")->setData($loggedUser->getForename());
		$settingsForm->get("surname")->setData($loggedUser->getSurname());
		$settingsForm->get("number")->setData($loggedUser->getNumber());

		if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
			$values = $request->request->all();

			try {
				$userService->editSettings($loggedUser, $values["settings_form"]);
				$this->addFlash("success", "Data byla uložena");
			} catch (\Exception $e) {
				$this->addFlash("failure", "Během ukládání dat nastala chyba");
			}
		}

		if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
			$passwordFormData = $passwordForm->getData();
			$userService->editPassword($passwordFormData);
		}

		return $this->render("user/settings/settings.html.twig", [
			"passwordForm" => $passwordForm->createView(),
			"settingsForm" => $settingsForm->createView()
		]);
	}

}