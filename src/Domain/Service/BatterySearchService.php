<?php

namespace Micronomics\Passport\Domain\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Parameter;
use Micronomics\Passport\Domain\Dto\BatterySearchDto;
use Micronomics\Passport\Framework\Dto\SearchResultDto;
use Micronomics\Passport\System\Entity\BatteryEntity;

class BatterySearchService
{
    public function __construct(
        protected EntityManagerInterface $em,
    )
    {
    }

    public function search(BatterySearchDto $searchDto, int $page, int $pageSize): SearchResultDto
    {
        $parameters = new ArrayCollection();
        $qb = $this->em->createQueryBuilder()
            ->select('b')
            ->from(from: BatteryEntity::class, alias: 'b')
        ;

        if(!empty($searchDto->modelIds)){
            $qb->andWhere("b.modelId IN (:modelIds)");
            $parameters->add(new Parameter(
                name: "modelIds",
                value: $searchDto->modelIds
            ));
        }

        if(!empty($searchDto->manufacturingCountries)){
            $qb->andWhere("b.manufacturingCountry IN (:manufacturingCountries)");
            $parameters->add(new Parameter(
                name: "manufacturingCountries",
                value: $searchDto->manufacturingCountries
            ));
        }

        if(!empty($searchDto->lifecycleStages)){
            $qb->andWhere("b.lifecycleStage IN (:lifecycleStages)");
            $parameters->add(new Parameter(
                name: "lifecycleStages",
                value: $searchDto->lifecycleStages
            ));
        }

        if($searchDto->ownerId !== null){
            $qb->andWhere("b.ownerId = :ownerId");
            $parameters->add(new Parameter(
                name: "ownerId",
                value: $searchDto->ownerId
            ));
        }

        $qb->setParameters($parameters);

        // TODO: Add count query to fill totalCount field (actual maximum results in the current query)

        $result = $qb->getQuery()
            ->setFirstResult(($page - 1) * $pageSize)
            ->setMaxResults($pageSize)
            ->getResult();


        return new SearchResultDto()
            ->setPage($page)
            ->setPageSize($pageSize)
            ->setTotalCount(0)
            ->setItems($result);
    }
}
