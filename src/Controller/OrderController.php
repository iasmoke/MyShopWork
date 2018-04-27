<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    /**
     * @Route("/cart/add/{id}/{quantityOrder}", name="order_add_to_cart")
     */
    public function addToCard(
        Product $product,
        Orders $orders,
        Request $request,
        $quantityOrder = 1)
    {
        $orders->addToCart($product, $quantityOrder);


        return $this->redirect($request->headers->get('referer','/'));

    }
}
