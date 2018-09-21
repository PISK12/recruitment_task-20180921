<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 21/09/2018
	 * Time: 15:20
	 */

	namespace AppBundle\DataFixtures\ORM;


	use AppBundle\Entity\User;
	use Doctrine\Common\DataFixtures\FixtureInterface;
	use Doctrine\Common\Persistence\ObjectManager;
	use Faker\Factory;
	use Symfony\Component\DependencyInjection\ContainerAwareInterface;
	use Symfony\Component\DependencyInjection\ContainerInterface;

	class LoadUserData implements FixtureInterface, ContainerAwareInterface
	{
		protected $container;

		/**
		 * Load data fixtures with the passed EntityManager
		 *
		 * @param ObjectManager $manager
		 */
		public function load(ObjectManager $manager)
		{
			$faker=Factory::create('pl_PL');
			$user = new User();
			$user
				->setUsername("admin")
				->setEmail("admin@admin.pl")
				->setName("Jan")
				->setSurname("Kowalski")
				->setPosition("Szef wszystkich szefów");

			$dateOfBirth=\DateTime::createFromFormat("Y-m-d","1999-12-01");
			$user->setDateOfBirth($dateOfBirth);

			$encoder=$this->container->get('security.password_encoder');
			$password=$encoder->encodePassword($user,'0000');
			$user->setPassword($password);

			$manager->persist($user);
			for($i=0;$i<40;$i++){
				$user = new User();
				$user
					->setUsername("user".$faker->word.$faker->word)
					->setEmail("user".$i."@user.pl")
					->setName($faker->firstName)
					->setSurname($faker->lastName)
					->setPosition($faker->randomElement(
						["sprzedawca","konsultant","programista","dyrektor"]
					));

				$dateOfBirth=\DateTime::createFromFormat("Y-m-d",$faker->date("Y-m-d",'-20 years'));
				$user->setDateOfBirth($dateOfBirth);

				$encoder=$this->container->get('security.password_encoder');
				$password=$encoder->encodePassword($user,"user".$i);
				$user->setPassword($password);

				$manager->persist($user);
			}
			$manager->flush();



		}

		public function setContainer(ContainerInterface $container = null)
		{
			$this->container=$container;
		}
	}