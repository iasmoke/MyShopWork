<?php

namespace App\Controller;


use App\Entity\OrderItem;
use App\Entity\Product;
use App\Service\Orders;
use http\Exception\InvalidArgumentException;
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
        $orders->addToCart($product, $quantityOrder, $this->getUser());

        if ($request->isXmlHttpRequest()){
            return$this->render('order/header_cart.html.twig',[
                'cart' => $orders->getCart(),
            ]);
        }


        return $this->redirect($request->headers->get('referer','/'));

    }

    /**
     *
     * @Route("/order", name="order")
     */
    public function order(Orders $orders)
    {
       $cart = $orders->getCart($this->getUser());
        return $this->render('order/cart.html.twig', [
            'cart'=> $cart
        ]);

    }

    /**
     * @Route("/cart/header", name="order_header_cart")
     */
    public function headercart(Orders $orders){
        return$this->render('order/header_cart.html.twig',[
        'cart' => $orders->getCart(),
    ]);
    }

    /**
     *@Route("/order/item/delete/{id}", name ="order_delete")
     */
        public function removeFromCart(Orders $orders, OrderItem $item)
        {
          $cart = $orders->removeFromCart($item);

            return $this->render('order/cart_table.html.twig', [
                'cart' => $cart,
            ]);

        }

    /**
     * @Route("/cart/update/{id}/{quantity}", name="order_update_item_quantity")
     */
        public function updateCartItemQuantity(Orders $orders, OrderItem $item, $quantity)
        {
            $quantity=(int)$quantity;

            if ($quantity <= 0) {
                $quantity = $item->getQuantityOrder();

            }

            $cart = $orders->updateCartItemQuantity($item, $quantity);

                return $this->render('order/cart_table.html.twig', [
                    'cart' => $cart,
                ]);

        }
}
