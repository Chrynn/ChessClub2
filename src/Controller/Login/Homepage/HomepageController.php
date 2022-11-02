<?php declare(strict_types = 1);

namespace App\Controller\Login\Homepage;

use App\Controller\Login\LoginController;
use App\Entity\UserEntity;
use LoginForm;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomepageController extends LoginController
{

	#[Route('/login')]
	public function index(AuthenticationUtils $authenticationUtils, Request $request): Response
	{
		$form = $this->createForm(LoginForm::class, [
			"_username" => $authenticationUtils->getLastUsername(),
		]);

		$error = $authenticationUtils->getLastAuthenticationError();

		if ($error !== NULL) {
			$form->addError(new FormError("Chyba"));
		}

		return $this->render("login/homepage/homepage.html.twig", [
			"form" => $form->createView(),
		]);
	}

}