<?php declare(strict_types = 1);

namespace App\User\Settings\PasswordForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class PasswordForm extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add("password", PasswordType::class, [
				"required" => true,
				"attr" => ["class" => "text"]
			])
			->add("Save", SubmitType::class, [
				"attr" => ["class" => "button"]
			]);
	}

}