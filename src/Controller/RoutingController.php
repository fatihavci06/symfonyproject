<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RoutingController extends AbstractController
{
    /**
     * @Route({
     *      "en":"/about",
     *      "tr":"/hakkinda"
     * },name="about")
     */
    public function index(): Response
    {
       return new JsonResponse(['Message'=>"Hakkinda sayfası"]);
    }
    /**
     * @Route("/blog/{page<\d+>}",name="blog_listele")
     */
    public function listele($page)
    {
        return new Response($page);
    }
    /**
     * @Route("/blog/{postSlug}",name="blog_listele2")
     */
    public function listeleWithSlug($postSlug)
    {
         return new Response($postSlug);
    }
    /**
     * @Route("/routing/hello/{_locale}",defaults={"_locale"="tr"},requirements={"_locale"="tr|en"})
     */
    public function helloRouting($_locale)
    {
         return new Response($_locale);
    }
    /**
     * @Route("/api/hello/{id<\d+>}",methods={"GET","HEAD"})
     */
    public function showPost($id)
    {
         return new Response($id);
    }
    /**
     * @Route("/post-listele/{id<\d+>?2}",methods={"GET","HEAD"})// <\d+>=integer zorunluluğu ? ile default 2 değeri alaak
     */
    public function postList($id)
    {
         return new Response($id);
    }
    /**
     * @Route("/makaleler/{_locale}/{yil}/{slug}.{_format}",defaults={"_format":"html"},
     *      requirements={"_locale":"tr|en","_format":"html|json","yil":"\d+"} 
     * )
     */
    public function showMakale($_locale,$yil)
    {
         return new Response($yil);
    }
    /**
     * @Route("url-generate",methods={"GET","HEAD"})
     */
    public function urlUret()
    {
        $uri = $this->generateUrl('app_routing_showmakale', ["_locale" =>"en","yil"=>1990,"slug"=>"kaliteli-hzmet","_format"=>"html"]);
         return new Response($uri);
    }
    /**
     * @Route("url-generate2")
     */
    public function urlUret2()
    {
        $uri = $this->generateUrl('app_routing_showpost', ["id" =>"12","yil"=>1990,"slug"=>"kaliteli-hzmet"],UrlGeneratorInterface::ABSOLUTE_URL);
         return new Response($uri);
    }
}
