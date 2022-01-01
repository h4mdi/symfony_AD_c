<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index")
     */
    public function index(ProductRepository $productRepository,SessionInterface $session)
    {  $panier=$session->get('panier',[]);
        return $this->render('home/list.html.twig', [
            'products' => $productRepository->findAll(),'panier'=> $panier
        ]);
    }

    
}
