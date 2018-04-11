<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderItemRepository")
 * @ORM\Table(name="ordersItem")
 */
class OrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quantityOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priceOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valueOrder;

    public function getId()
    {
        return $this->id;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantityOrder(): ?string
    {
        return $this->quantityOrder;
    }

    public function setQuantityOrder(string $quantityOrder): self
    {
        $this->quantityOrder = $quantityOrder;

        return $this;
    }

    public function getPriceOrder(): ?string
    {
        return $this->priceOrder;
    }

    public function setPriceOrder(string $priceOrder): self
    {
        $this->priceOrder = $priceOrder;

        return $this;
    }

    public function getValueOrder(): ?string
    {
        return $this->valueOrder;
    }

    public function setValueOrder(string $valueOrder): self
    {
        $this->valueOrder = $valueOrder;

        return $this;
    }
}
