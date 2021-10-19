<?php

namespace App\Controller;

use App\Entity\Table1;
use App\Repository\Table1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Appointments;
//include paginator interface
use Knp\Component\Pager\PaginatorInterface;



class HelloController extends ApiController
{

    private $table1Repository;

    public function __construct(Table1Repository $table1Repository)
    {
        $this->tableRepository = $table1Repository;
    }


    /**
    * @Route("/hello/showall", methods={"GET"})
    */
    public function index(Table1Repository $table1Repository, PaginatorInterface $paginator, Request $request){

        $tables=$table1Repository->transformAll();

        $tables=$paginator->paginate($tables, $request->query->getInt('page', 1), 5);
        
        return $this->render('hello/index.html.twig',['table'=>$tables]);
    }

    /**
    *  @Route("/hello/show/{id}", methods={"GET"})
    */
    public function show($id, Table1Repository $table1Repository){
        $table1=$table1Repository->find($id);

        if (! $table1) {
            return $this->respondNotFound();
        }

        $table1=$table1Repository->transform($table1);
        return $this->respond($table1);
    }


    /**
    *  @Route("/hello/register", methods={"POST"})
    */
    public function create(Request $request):JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $Title = $data['Title'];
  

        if (empty($Title) ) {
            return $this->json(['status' => 'Title is empty please complete'], JsonResponse::HTTP_CREATED);
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->tableRepository->saveTable($id, $Title);

        return $this->json(['status' => 'New line created! Good Job'], JsonResponse::HTTP_CREATED);
    }

    /**
    *  @Route("/hello/delete/{id}", methods={"DELETE"})
    */
    public function delete($id):JsonResponse
    {
        $line = $this->tableRepository->findOneBy(['id' => $id]);

        $this->tableRepository->deleteLine($line);

        return new JsonResponse(['status' => 'Line deleted'], Response::HTTP_CREATED);

    }

}
