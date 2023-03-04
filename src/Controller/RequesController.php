<?php

namespace App\Controller;

use App\Service\NameGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RequesController extends AbstractController
{
    /**
     * @Route("/reques", name="app_reques")
     */
    public function index(): Response
    {
        return $this->render('reques/index.html.twig', [
            'controller_name' => 'RequesController',
        ]);
    }
    /**
     * @Route("/request", name="request_test")
     * @param RequestStack $requestStack
     * @return Response
     */
    public function requestTest(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();

        // $_POST  ile gelen requesti yakalarız
        $name = $request->request->get('name');
        echo $name;
        
        // $_GET ile gelen requesti yakalarız
        $name = $request->query->get('name', 'Orhan');// name diye parametre gelmezse Orhan değerini alır
        
        // $_COOKIE
        $request->cookies->get('username');

        // karşılığı yok
        $request->attributes->get('name');

        // $_FILES
        $request->files->get('filename');

        // $_SERVER
        $serverData = $request->server->get('REMOTE_ADDR');
        $serverData;
        
        $headers = $request->headers->all();
        dd($headers);
        die;
        return new Response('Request');
    }
    /**
     * @Route("/response", name="response_test")
     * @param RequestStack $requestStack
     * @return Response
     */
    public function responseTest(RequestStack $requestStack)
    {
        return $this->redirectToRoute('request_test');
        return $this->render('reques/index.html.twig', [
            'controller_name' => 'RequesController',
        ]);
        return new JsonResponse(['data'=>2]);
        return new Response('hello');
        
    }
    /**
     * @Route("/service", name="servis_test")
     * @param SessionInterface $session
     * @return Response
     */
    public function serviceTest(SessionInterface $session)
    {
        return new Response($session->getName());
    }
    /**
     * @Route("service2")
     */
    public function service2(NameGenerator $name):Response
    {
       $names=$name->randomName();
       return new JsonResponse(['name'=>$names]);
    }
}
