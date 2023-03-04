<?php 

namespace App\Service;
use App\Service\NameGenerator;
use Symfony\Component\HttpFoundation\RequestStack;
class MessageGenerator
{
	private $nameGenerator;
	private $requeststack;
	private $adminEmail;
	public function __construct(NameGenerator $namegenerator,RequestStack $request_stack, $adminEmail=""){
		$this->nameGenerator=$namegenerator;
		$this->requeststack=$request_stack;
		$this->adminEmail = $adminEmail;

	}
	public function helloMessage()
	{

		$name = $this->requeststack->getCurrentRequest()->get('name');

        if(empty($name)){
            $name = $this->nameGenerator->randomName();
        }
        $message = 'Hello '.$name.'->admin:'.$this->adminEmail;

        return $message;
	}
}

?>