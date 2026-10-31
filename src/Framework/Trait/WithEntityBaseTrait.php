<?php

namespace Micronomics\Passport\Framework\Trait;
use Doctrine\ORM\Mapping as ORM;

trait WithEntityBaseTrait
{
    use WithEntityUuidTrait;

    #[ORM\Column(nullable: true)]
    protected ?\DateTime $updatedAt = null;

    #[ORM\Column]
    protected ?\DateTimeImmutable $createdAt = null;

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PreUpdate]
    public function lifecycleUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }

    #[ORM\PrePersist]
    public function lifecycleCreated(): void {
        $this->createdAt = new \DateTimeImmutable();
    }
}
