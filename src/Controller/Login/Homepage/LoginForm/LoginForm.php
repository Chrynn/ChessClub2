<?php declare(strict_types = 1);

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add("_username", TextType::class, [
				"required" => true,
				"attr" => ["class" => "text"]
			])
			->add("_password", PasswordType::class, [
				"required" => true,
				"attr" => ["class" => "text"]
			])
			->add("login", SubmitType::class, [
				"attr" => ["class" => "button"]
			]);
	}

}