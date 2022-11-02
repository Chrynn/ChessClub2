<?php declare(strict_types = 1);

namespace App\User\Settings\SettingsForm;

use App\Entity\UserEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsForm extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add("nickname", TextType::class, [
				"required" => true,
				"attr" => [
					"class" => "text",
					"readonly" => true
				]
			])
			->add("forename", TextType::class, [
				"required" => false,
				"attr" => ["class" => "text"]
			])
			->add("surname", TextType::class, [
				"required" => false,
				"attr" => ["class" => "text"]
			])
			->add("number", TextType::class, [
				"required" => false,
				"attr" => ["class" => "text"]
			])
			->add("save", SubmitType::class, [
				"attr" => ["class" => "button"]
			]);
	}


	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => UserEntity::class,
			"nickname" => ""
		]);
	}

}