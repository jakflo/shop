<?php

namespace app\pages\order;

class OrderEntity extends \app\conf\BaseEntity
{
    protected int $id;
    protected int $user_id;
    protected float $price;
    protected string $currency;
    protected string $created;
    protected ?string $note;
    protected string $state;
    
    /**
     * array entit OrderItem
     * @var array
     */
    protected array $items = [];

    public function __construct(
        int $id,
        int $user_id,
        float $price,
        string $created,
        ?string $note, 
        string $currency,
        string $state
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->price = $price;
        $this->created = $created;
        $this->note = $note;
        $this->currency = $currency;
        $this->state = $state;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function getCreated(): string {
        return $this->created;
    }

    public function getNote(): ?string {
        return $this->note;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getItems(): array {
        return $this->items;
    }

    // Setters
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setUserId(int $user_id): self {
        $this->user_id = $user_id;
        return $this;
    }

    public function setPrice(float $price): self {
        $this->price = $price;
        return $this;
    }

    public function setCurrency(string $currency): self {
        $this->currency = $currency;
        return $this;
    }

    public function setCreated(string $created): self {
        $this->created = $created;
        return $this;
    }

    public function setNote(?string $note): self {
        $this->note = $note;
        return $this;
    }

    public function setState(string $state): self {
        $this->state = $state;
        return $this;
    }

    public function setItems(array $items): self {
        $this->items = $items;
        return $this;
    }
    
}
