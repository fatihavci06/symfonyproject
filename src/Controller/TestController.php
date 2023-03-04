<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test2", name="app_test")
     */
    public function index(): Response
    {

        if($_ENV['NETGSM_USERCODE']!=null)
        {
            $usercode=$_ENV['NETGSM_USERCODE'];
        }
        elseif(env('NETGSM_USERCODE')!=null)
        {
            $usercode=env('NETGSM_USERCODE');
        }

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'usercode'=>$usercode
        ]);
    }
}
