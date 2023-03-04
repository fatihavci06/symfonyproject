<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateFiltersController extends AbstractController
{
    /**
     * @Route("/template/filters", name="app_template_filters")
     */
    public function index(): Response
    {
        return $this->render('template_filters/index.html.twig', [
            'controller_name' => 'TemplateFiltersController',
            'negativeVar' => -25,
            'sentence' => '   merhaba Ben behram    ',
            'bugun' => new \DateTime(),
            'sehirler' => [
                'kerem' => 'Angara',
                'ayse' => 'Eskişehir',
                'ilhami' => 'Aksaray',
                'ali' => 'Erzurum',
            ],
            'rawData' => '<h3>Selam Dünya!</h3>'
        ]);
    }
}
