<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 21/09/2018
	 * Time: 17:44
	 */

	namespace AppBundle\Form;


	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\DateType;
	use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
	use Symfony\Component\Form\FormBuilderInterface;



	use Symfony\Component\OptionsResolver\OptionsResolver;

	class UserType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			$builder
				->add('username',TextType::class)
				->add('email',EmailType::class)
				->add('password',RepeatedType::class,['type'=>PasswordType::class])
				->add('name',TextType::class)
				->add('surname',TextType::class)
				->add('position',TextType::class)
				->add('dateOfBirth',DateType::class,array(
					'widget' => 'single_text',
					'format' => 'yyyy-MM-dd',
				))
				->add("submit",SubmitType::class);
		}


	}