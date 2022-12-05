<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\AdvantageBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeSavedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageInvalidException;
use Evrinoma\AdvantageBundle\Exception\AdvantageNotFoundException;
use Evrinoma\AdvantageBundle\Facade\Advantage\FacadeInterface;
use Evrinoma\AdvantageBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class AdvantageApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/advantage/create", options={"expose": true}, name="api_advantage_create")
     * @OA\Post(
     *     tags={"advantage"},
     *     description="the method perform create advantage",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\AdvantageBundle\Dto\AdvantageApiDto",
     *                     "id": "48",
     *                     "name": "Instagram",
     *                     "url": "http://www.instagram.com/intertechelectro",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\AdvantageBundle\Dto\AdvantageApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="url", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create advantage")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var AdvantageApiDtoInterface $advantageApiDto */
        $advantageApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_ADVANTAGE;

        try {
            $this->facade->post($advantageApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create advantage', $json, $error);
    }

    /**
     * @Rest\Put("/api/advantage/save", options={"expose": true}, name="api_advantage_save")
     * @OA\Put(
     *     tags={"advantage"},
     *     description="the method perform save advantage for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\AdvantageBundle\Dto\AdvantageApiDto",
     *                     "active": "b",
     *                     "id": "48",
     *                     "name": "Instagram",
     *                     "url": "http://www.instagram.com/intertechelectro",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\AdvantageBundle\Dto\AdvantageApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="url", type="string"),
     *                 @OA\Property(property="active", type="string")
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save advantage")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var AdvantageApiDtoInterface $advantageApiDto */
        $advantageApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_ADVANTAGE;

        try {
            $this->facade->put($advantageApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save advantage', $json, $error);
    }

    /**
     * @Rest\Delete("/api/advantage/delete", options={"expose": true}, name="api_advantage_delete")
     * @OA\Delete(
     *     tags={"advantage"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\AdvantageBundle\Dto\AdvantageApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete advantage")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var AdvantageApiDtoInterface $advantageApiDto */
        $advantageApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($advantageApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete advantage', $json, $error);
    }

    /**
     * @Rest\Get("/api/advantage/criteria", options={"expose": true}, name="api_advantage_criteria")
     * @OA\Get(
     *     tags={"advantage"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\AdvantageBundle\Dto\AdvantageApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="name",
     *         in="query",
     *         name="name",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="url",
     *         in="query",
     *         name="url",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return advantage")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var AdvantageApiDtoInterface $advantageApiDto */
        $advantageApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_ADVANTAGE;

        try {
            $this->facade->criteria($advantageApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get advantage', $json, $error);
    }

    /**
     * @Rest\Get("/api/advantage", options={"expose": true}, name="api_advantage")
     * @OA\Get(
     *     tags={"advantage"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\AdvantageBundle\Dto\AdvantageApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return advantage")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var AdvantageApiDtoInterface $advantageApiDto */
        $advantageApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_ADVANTAGE;

        try {
            $this->facade->get($advantageApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get advantage', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof AdvantageCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof AdvantageNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof AdvantageInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
