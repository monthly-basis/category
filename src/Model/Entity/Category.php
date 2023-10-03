<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Entity;

class Category
{
    protected int $categoryId;
    protected string $description;
    protected string $imageRru;
    protected string $name;
    protected string $slug;
    public int $questionCountCached;

    public function __get(string $name): mixed
    {
        return $this->$name;
    }

    public function __isset(string $name): bool
    {
        return isset($this->$name);
    }

    public function __set(string $name, mixed $value): void
    {
        $this->$name = $value;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
}
