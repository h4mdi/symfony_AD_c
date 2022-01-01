<?php

namespace App\Controller;

use App\Entity\Pfe;
use App\Entity\Product;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\PfeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/admin", name="admin")
     */
    public function adminhome(): Response
    {
        return $this->render('admin/admin.html.twig');
    }


    /**
     * @Route("/add_dest", name="add_dest")
     */
    public function addDest(Request $request): Response
    {
        $d = new Product();
        $destname = $request->request->get('destname');
        $image =$request->request->get('destimg');
        $destcat = $request->request->get('destcat');
        $destprice = $request->request->get('destprice');

        $d->setTitle($destname);
        $d->setCat($destcat);
        $d->setImage($image);
        $d->setPrice((float)$destprice) ;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($d);
        $entityManager->flush();



        return $this->redirectToRoute('product_index');


    }

}

