<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{

    const STATUS_DRAFT = 0;
    const STATUS_ORDERED = 1;
    const STATUS_SENT = 2;
    const STATUS_DONE = 3;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"default": 0})
     */
    private $status;


    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private $paymentState;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn()
     */
    private $user;
    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, options={"default": 0})
     */
    private $sumOrder;

    /**
     * @var OrderItem[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="order")
     */
    private $items;


    public function __construct()
    {
        $this->status = self::STATUS_DRAFT;
        $this->dateTime = new \DateTime();
        $this->paymentState = false;
        $this->sumOrder = 0;
        $this->items = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->Status;
    }

    public function setStatus(int $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getPaymentState(): ?bool
    {
        return $this->paymentState;
    }

    public function setPaymentState(?bool $paymentState): self
    {
        $this->paymentState = $paymentState;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSumOrder()
    {
        return $this->sumOrder;
    }

    public function setSumOrder($sumOrder): self
    {
        $this->sumOrder = $sumOrder;

        return $this;
    }



    /**
     * @return Collection|OrderItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrder($this);
            $this->updateValueOrder();
        }
        return $this;
    }

    public function removeItem(OrderItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getOrder() === $this) {
                $item->setOrder(null);
            }
            $this->updateValueOrder();
        }
        return $this;
    }
    public function updateValueOrder()
    {
        $total = 0;

            foreach ($this->items as $item) {
                $total += $item->getvalueOrder();
            }
        $this->sumOrder = $total;
    }

    public function getProductsCount()
    {
        $count = 0;
        foreach ($this->items as $item){
            $count += $item->getQuantityOrder();
        }
        return $count;
    }
}
