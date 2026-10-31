<?php

namespace Micronomics\Passport\System\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Micronomics\Passport\Domain\Enum\BatteryLifecycleEnum;
use Micronomics\Passport\Framework\Client\MarketplaceClient;
use Micronomics\Passport\Framework\Trait\WithEntityBaseTrait;
use Micronomics\Passport\System\Repository\BatteryRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Micronomics\Passport\System\Validator\Constraints as CustomAssert;

#[ORM\Entity(repositoryClass: BatteryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class BatteryEntity
{
    use WithEntityBaseTrait;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    #[ORM\Column(length: 100)]
    protected ?string $serialNumber = null;

    #[Assert\Length(max: 100)]
    #[ORM\Column(length: 100)]
    protected ?string $batchNumber = null;

    #[Assert\NotBlank]
    #[CustomAssert\ReferencedEntityConstraint(
        clientClass: MarketplaceClient::class,
        entityName: MarketplaceClient::ENTITY_BATTERY_MODEL
    )]
    #[ORM\Column(length: 255)]
    protected ?string $modelId = null;

    #[ORM\Column(length: 255)]
    protected ?string $ownerId = null;

    #[Assert\NotNull]
    #[Assert\LessThanOrEqual('today')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTime $manufacturedAt = null;

    #[Assert\NotBlank]
    #[Assert\Country(alpha3: true)]
    #[Assert\Length(exactly: 3)]
    #[ORM\Column(length: 3)]
    protected ?string $manufacturingCountry = null;

    #[Assert\NotNull]
    #[ORM\Column(enumType: BatteryLifecycleEnum::class)]
    protected ?BatteryLifecycleEnum $lifecycleStage = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    protected ?BatteryWarrantyEntity $warranty = null;

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): static
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getBatchNumber(): ?string
    {
        return $this->batchNumber;
    }

    public function setBatchNumber(?string $batchNumber): BatteryEntity
    {
        $this->batchNumber = $batchNumber;
        return $this;
    }

    public function getModelId(): ?string
    {
        return $this->modelId;
    }

    public function setModelId(string $modelId): static
    {
        $this->modelId = $modelId;

        return $this;
    }


    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    public function setOwnerId(?string $ownerId): BatteryEntity
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    public function getManufacturedAt(): ?\DateTime
    {
        return $this->manufacturedAt;
    }

    public function setManufacturedAt(\DateTime $manufacturedAt): static
    {
        $this->manufacturedAt = $manufacturedAt;

        return $this;
    }

    public function getManufacturingCountry(): ?string
    {
        return $this->manufacturingCountry;
    }

    public function setManufacturingCountry(string $manufacturingCountry): static
    {
        $this->manufacturingCountry = $manufacturingCountry;

        return $this;
    }

    public function getLifecycleStage(): ?BatteryLifecycleEnum
    {
        return $this->lifecycleStage;
    }

    public function setLifecycleStage(BatteryLifecycleEnum $lifecycleStage): static
    {
        $this->lifecycleStage = $lifecycleStage;

        return $this;
    }

    public function getWarranty(): ?BatteryWarrantyEntity
    {
        return $this->warranty;
    }

    public function setWarranty(?BatteryWarrantyEntity $warranty): static
    {
        $this->warranty = $warranty;

        return $this;
    }
}
