<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderItemRepository")
 * @ORM\Table(name="ordersItems")
 */
class OrderItem
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="orderItems")
     * @ORM\JoinColumn()
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $quantityOrder;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, options={"default": 0})
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, options={"default": 0})
     */
    private $valueOrder;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="items")
     * @ORM\JoinColumn()
     */
    private $order;

    public function __construct()
    {
        $this->quantity = 0;
        $this->price = 0;
        $this->valueOrder = 0;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getQuantityOrder(): ?string
    {
        return $this->quantityOrder;
    }

    public function setQuantityOrder(string $quantityOrder): self
    {
        $this->quantityOrder = $quantityOrder;
        $this->updateValueOrder();

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }
    public function setOrder(?Order $order): self
    {
        $this->order = $order;
        return $this;
    }
    public function getProduct(): ?Product
    {
        return $this->product;
    }
    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        $this->setPrice($product->getPrice());

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price): self
    {
        $this->price = $price;
        $this->updateValueOrder();
        return $this;
    }

    public function getValueOrder()
    {
        return $this->valueOrder;
    }

    private function updateValueOrder(){
        $this->valueOrder = round($this->price * $this->quantityOrder, 2);

        if($this->order){
            $this->order->updateValueOrder();
        }
    }
}
