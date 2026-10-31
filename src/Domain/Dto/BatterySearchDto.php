<?php

namespace Micronomics\Passport\Domain\Dto;
use Micronomics\Passport\Domain\Enum\BatteryLifecycleEnum;
use Symfony\Component\Validator\Constraints as Assert;

class BatterySearchDto
{
    #[Assert\NotBlank(allowNull: true)]
    #[Assert\All([
        new Assert\Sequentially(
            [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Uuid()
            ]
        )
    ])]
    protected(set) ?array $modelIds = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\All([
        new Assert\Sequentially(
            [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Length(exactly: 3),
                new Assert\Country(alpha3: true)
            ]
        )
    ])]
    protected(set) ?array $manufacturingCountries = null;


    #[Assert\NotBlank(allowNull: true)]
    #[Assert\All([
        new Assert\Sequentially(
            [
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\Choice(choices: [
                    BatteryLifecycleEnum::FIRST_LIFE->value,
                    BatteryLifecycleEnum::SECOND_LIFE->value,
                    BatteryLifecycleEnum::SURPLUS->value
                ])
            ]
        )
    ])]
    protected(set) ?array $lifecycleStages = null;

    #[Assert\NotBlank(allowNull: true)]
    protected(set) ?string $ownerId = null;

    public function setModelIds(?array $modelIds): BatterySearchDto
    {
        $this->modelIds = $modelIds;
        return $this;
    }

    public function setManufacturingCountries(?array $manufacturingCountries): BatterySearchDto
    {
        $this->manufacturingCountries = $manufacturingCountries;
        return $this;
    }

    public function setLifecycleStages(?array $lifecycleStages): BatterySearchDto
    {
        $this->lifecycleStages = $lifecycleStages;
        return $this;
    }

    public function setOwnerId(?string $ownerId): BatterySearchDto
    {
        $this->ownerId = $ownerId;
        return $this;
    }
}
