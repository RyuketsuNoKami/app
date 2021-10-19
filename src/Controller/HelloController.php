<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends ApiController
{
    #[Route('/hello', name: 'hello')]
    public function HelloWorldJsonResponse()
    {
        return $this->respond([
            [
                'Hello World'
            ]
        ]);
    }
}
