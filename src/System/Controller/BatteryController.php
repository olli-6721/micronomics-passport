<?php

namespace Micronomics\Passport\System\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Micronomics\Passport\Framework\Exception\InternalException;
use Micronomics\Passport\Framework\Serializer\SerializerFactory;
use Micronomics\Passport\System\Entity\BatteryEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\OidcUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

class BatteryController extends AbstractController
{
    public function __construct(
        protected EntityManagerInterface $em
    ){}

    /**
     * @param BatteryEntity $entity
     * @param OidcUser $user
     * @return JsonResponse
     * @throws Throwable
     */
    #[Route("/api/batteries", name: 'api.battery.register', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] BatteryEntity $entity,
        UserInterface $user
    ): JsonResponse
    {
        try {
            $entity->setOwnerId($user->getUserIdentifier());

            $this->em->persist($entity);
            $this->em->flush();

            return new JsonResponse(
                data: SerializerFactory::create()
                    ->serialize($entity, 'json'),
                status: Response::HTTP_OK,
                json: true
            );
        }
        catch (Throwable $e){
            return $this->handleException($e);
        }
    }

    /**
     * @throws Throwable
     */
    #[Route("/api/batteries/{id}", name: 'api.battery.get', methods: ['GET'])]
    public function get(Uuid $id): JsonResponse
    {
        try {
            $entity = $this->em->getRepository(BatteryEntity::class)->find($id);
            if($entity === null){
                return new JsonResponse(null, Response::HTTP_NOT_FOUND);
            }

            return new JsonResponse(
                data: SerializerFactory::create()
                    ->serialize($entity, 'json'),
                status: Response::HTTP_OK,
                json: true
            );
        }
        catch (Throwable $e){
            return $this->handleException($e);
        }
    }

    /**
     * @throws Throwable
     */
    protected function handleException(Throwable $e): JsonResponse
    {
        if($e instanceof InternalException){
            // TODO: Implement Logging

            return new JsonResponse([
                "error" => "Internal server error"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        throw $e;
    }
}
