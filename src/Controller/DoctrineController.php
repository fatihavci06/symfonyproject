<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctrineController extends AbstractController
{
    /**
     * @Route("/bind-sql", name="app_bind-sql")
     */
    public function bindsql(): Response
    {
        $conn = $this->getDoctrine()
            ->getConnection();
        

        $sql = 'SELECT * FROM urun where performans > :degisken';

        $statement = $conn->prepare($sql);

        $result =  $statement->execute(array('degisken' => 5));

        

        dd($result->fetchAll());
        exit();
    }
    /**
     * @Route("/saf-sql", name="app_saf-sql")
     */
    public function index(): Response
    {

        
        $conn = $this->getDoctrine()
            ->getConnection();
        

        $sql = 'SELECT isim FROM urun LIMIT 5';

        $statement = $conn->prepare($sql);

        $result = $statement->execute();

        

        dd($result->fetchAll());
        exit();
       

        // actually executes the queries (i.e. the INSERT query)
        
        return $this->render('doctrine/index.html.twig', [
            'controller_name' => 'DoctrineController',
        ]);
    }
}
