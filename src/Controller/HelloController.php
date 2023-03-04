<?php 

namespace App\Controller;
use App\Service\NameGenerator;
use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class HelloController extends Controller
{
	private $requeststack;
	/**
     * @Route("/hello")
     * @return Response
     */
	public function hello():Response
	{
		 $name=$this->container->get(NameGenerator::class);
		
		
		
		$a=$name->randomName();
		return new Response($a);
	}
	/**
     * @Route("/hello2")
     * @return Response
     */
	public function hello2(MessageGenerator  $messagegenerator)
	{
		
		return new Response($messagegenerator->helloMessage());

	}
}

?>