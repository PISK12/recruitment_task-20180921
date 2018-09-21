<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     */
    public function registerAction()
    {
        return $this->render('AppBundle:Register:register.html.twig', array(
            // ...
        ));
    }

}
