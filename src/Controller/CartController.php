<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProductRepository;


class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session,ProductRepository $productRepository)
    {
        $panier=$session->get('panier',[]);
        $panierWithData=[];

        foreach ($panier as $id => $quantiy) {
            $panierWithData[]=[
                'product'=> $productRepository->find($id),
                'quantity'=> $quantiy
            ];
        }

        $total=0;
        foreach ($panierWithData as $item) {
            $totalItem=$item['product']->getPrice()*$item['quantity'];
            $total=$total+$totalItem;    
            # code...
        }
        //dd($panierWithData);
        return $this->render('home/index.html.twig', [
            'items'=> $panierWithData,
            'total'=>$total,'panier'=> $panier]
            
        );
    }



    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id,SessionInterface $session)
    {
        $panier=$session->get('panier',[]);
        if (!empty($panier[$id])) {
            $panier[$id]++ ;

        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
return $this-> redirectToRoute("product_index");
    }

     /**
     * @Route("/panier/min/{id}", name="cart_min")
     */
    public function min($id,SessionInterface $session)
    {
        $panier=$session->get('panier',[]);
        if (!empty($panier[$id])) {
            $panier[$id]-- ;

        }else {unset($panier[$id]) ;}
        $session->set('panier',$panier);
        return $this-> redirectToRoute("cart_index");


}

    /**
     * @Route("/panier/remove/{id}", name="cart_remv")
     */
    public function remove($id,SessionInterface $session)
    {
        $panier=$session->get('panier',[]);
        if (!empty($panier[$id])) {
            unset($panier[$id]) ;
        }
        $session->set('panier',$panier);
        return $this-> redirectToRoute("cart_index");


}


}