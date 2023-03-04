<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateExtensionController extends AbstractController
{
    /**
     * @Route("/template/extension", name="app_template_extension")
     */
    public function index(): Response
    {
        return $this->render('template_extension/index.html.twig', [
            'sentence' => 'Merhaba Ben Behram!',
        ]);
    }
}
