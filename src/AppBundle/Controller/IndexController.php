<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @Route("/",name="homepage")
     * @Route("/index")
     */
    public function indexAction(EntityManagerInterface $entityManager)
    {

	    $securityContext = $this->container->get('security.authorization_checker');
	    if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
		    $repository=$entityManager->getRepository(User::class);
		    $all_data_of_users=$repository->findAll();
		    $select_data_of_users=[];
		    foreach ($all_data_of_users as $user){
			    $select_data_of_users[]=[
				    "username"=>$user->getUsername(),
				    "email"=>$user->getEmail(),
				    "position"=>$user->getPosition(),
				    "DateOfBirth"=>$user->getDateOfBirth(),
				    "name"=>$user->getName(),
				    "surname"=>$user->getSurname()
			    ];
		    }
		    return $this->render('AppBundle:Index:index.html.twig',
			    array(
			    	"dataForTable"=>$select_data_of_users,
				    'columns'=>array(
				    	'name','surname',
					    'position','DateOfBirth',
					    'username','email'),
			    )
		    );
	    }else{
		    return $this->redirectToRoute('login');
	    }
    }

}
