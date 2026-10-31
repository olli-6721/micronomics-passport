<?php

namespace Micronomics\Passport\System\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Micronomics\Passport\Domain\Enum\BatteryWarrantyIssuerEnum;
use Micronomics\Passport\Framework\Trait\WithEntityBaseTrait;
use Micronomics\Passport\System\Repository\BatteryWarrantyRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BatteryWarrantyRepository::class)]
#[ORM\HasLifecycleCallbacks]
class BatteryWarrantyEntity
{
    use WithEntityBaseTrait;

    #[Assert\NotNull]
    #[ORM\Column(enumType: BatteryWarrantyIssuerEnum::class)]
    protected ?BatteryWarrantyIssuerEnum $issuer = null;

    #[Assert\NotNull]
    #[Assert\LessThanOrEqual('today')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTime $startDate = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    #[ORM\Column]
    protected ?int $durationYears = null;

    #[Assert\Positive]
    #[ORM\Column(nullable: true)]
    protected ?int $maxEnergyThroughputMwh = null;

    #[Assert\Range(min: 0, max: 100)]
    #[ORM\Column(nullable: true)]
    protected ?int $minGuaranteedSoH = null;

    #[Assert\Positive]
    #[ORM\Column(nullable: true)]
    protected ?int $maxDistance = null;

    #[Assert\NotBlank]
    #[ORM\Column(nullable: true)]
    protected ?string $reference = null;

    public function getIssuer(): ?BatteryWarrantyIssuerEnum
    {
        return $this->issuer;
    }

    public function setIssuer(BatteryWarrantyIssuerEnum $issuer): static
    {
        $this->issuer = $issuer;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDurationYears(): ?int
    {
        return $this->durationYears;
    }

    public function setDurationYears(int $durationYears): static
    {
        $this->durationYears = $durationYears;

        return $this;
    }

    public function getMaxEnergyThroughputMwh(): ?int
    {
        return $this->maxEnergyThroughputMwh;
    }

    public function setMaxEnergyThroughputMwh(int $maxEnergyThroughputMwh): static
    {
        $this->maxEnergyThroughputMwh = $maxEnergyThroughputMwh;

        return $this;
    }

    public function getMinGuaranteedSoH(): ?int
    {
        return $this->minGuaranteedSoH;
    }

    public function setMinGuaranteedSoH(?int $minGuaranteedSoH): static
    {
        $this->minGuaranteedSoH = $minGuaranteedSoH;

        return $this;
    }

    public function getMaxDistance(): ?int
    {
        return $this->maxDistance;
    }

    public function setMaxDistance(?int $maxDistance): static
    {
        $this->maxDistance = $maxDistance;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): BatteryWarrantyEntity
    {
        $this->reference = $reference;
        return $this;
    }
}
