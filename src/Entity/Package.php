<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use BcMath\Number;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackageRepository::class)]
class Package
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'packages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductCategory $productCategory = null;

    #[ORM\Column(length: 255)]
    private ?string $Package = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $startPickup = null;

    #[ORM\Column]
    private ?\DateTime $endPickup = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'packages')]
    private ?Business $business = null;

    #[ORM\OneToOne(mappedBy: 'package', cascade: ['persist', 'remove'])]
    private ?Order $pickupOrder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductCategoryId(): ?ProductCategory
    {
        return $this->productCategory;
    }

    public function setProductCategoryId(?ProductCategory $productCategory): static
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    public function getPackage(): ?string
    {
        return $this->Package;
    }

    public function setPackage(string $Package): static
    {
        $this->Package = $Package;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartPickup(): ?\DateTime
    {
        return $this->startPickup;
    }

    public function setStartPickup(\DateTime $startPickup): static
    {
        $this->startPickup = $startPickup;

        return $this;
    }

    public function getEndPickup(): ?\DateTime
    {
        return $this->endPickup;
    }

    public function setEndPickup(\DateTime $endPickup): static
    {
        $this->endPickup = $endPickup;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    public function setBusiness(?Business $business): static
    {
        $this->business = $business;

        return $this;
    }

    public function getPickupOrder(): ?Order
    {
        return $this->pickupOrder;
    }

    public function setPickupOrder(Order $pickupOrder): static
    {
        // set the owning side of the relation if necessary
        if ($pickupOrder->getPackage() !== $this) {
            $pickupOrder->setPackage($this);
        }

        $this->pickupOrder = $pickupOrder;

        return $this;
    }
}
