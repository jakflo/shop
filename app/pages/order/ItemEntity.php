<?php

namespace app\pages\order;

class ItemEntity extends \app\conf\BaseEntity
{
    protected int $id;
    protected string $name;
    protected float $price;
    protected string $currency;
    protected int $amount;
    protected ?string $description;

    // Konstruktor třídy
    public function __construct(
        int $id,
        string $name,
        float $price,
        string $currency,
        ?string $description,
        int $amount
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->currency = $currency;
        $this->description = $description;
        $this->amount = $amount;
    }

    // Settery

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    // Gettery

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
    
}
