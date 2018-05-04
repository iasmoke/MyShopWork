<?php


namespace App\Service;


use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Orders
{
    const CART_ID = 'cart';

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    public function hasCart()
    {

        return $this->session->has(self::CART_ID);
    }

    public function getCart(User $user = null): Order
    {
        $order = null;
        $orderID = $this->session->get(self::CART_ID);


        if ($orderID !== null) {
            $order = $this->em->find(Order::class, $orderID);

        }
        if ($order === null) {
            $order = new Order();
            $this->em->persist($order);

        }

        if ($user) {
            $order->setUser($user);
        }
        $this->em->flush();
        $this->session->set(self::CART_ID, $order->getId());

        return $order;

    }

    public function addToCart(Product $product, $quantity, User $user = null): Order
    {
        $order = $this->getCart();
        $orderItem = null;


        foreach ($order->getItems() as $item) {
            if ($item->getProduct()->getID() == $product->getId()) {
                $orderItem = $item;
                break;
            }
        }

        if (!$orderItem) {
            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $this->em->persist($orderItem);
            $order->addItem($orderItem);

        }
        $orderItem->setQuantityOrder($orderItem->getQuantityOrder() + $quantity);

        $this->em->flush();

        return $order;
    }

    public function removeFromCart(OrderItem $item)
    {

        $this->em->remove($item);
        $cart = $this->getCart();
        $cart->updateValueOrder();
        $this->em->flush();

        return $cart;
    }

    public function updateCartItemQuantity(OrderItem $item, $quantityOrder)
    {
        $item->setQuantityOrder($quantityOrder);
        $this->em->flush();

        $cart = $this->getCart();
        $cart->updateValueOrder();
        $this->em->flush();
        return $cart;

    }
}
