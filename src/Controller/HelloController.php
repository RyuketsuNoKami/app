<?php

namespace App\Controller;

use App\Entity\Table1;
use App\Repository\Table1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;


class HelloController extends ApiController
{
    /**
    * @Route("/hello/showall", methods={"GET"})
    */
    public function index(Table1Repository $table1Repository){
       
        $tables=$table1Repository->transformAll();
        return $this->respond($tables);
        
    }

    /**
    *  @Route("/hello/{id}", methods={"GET"})
    */
    public function show($id, Table1Repository $table1Repository){
        $table1=$table1Repository->find($id);

        if (! $table1) {
            return $this->respondNotFound();
        }

        $table1=$table1Repository->transform($table1);
        return $this->respond($table1);
    }



}
