<?php

namespace PHPassword\Api;

use PHPassword\Api\Handler\ResourceApiHandlerInterface;
use PHPassword\Api\Validator\DataValidatorInterface;
use PHPassword\Api\Validator\NullDataValidator;

class ResourceApi
{
    public const ACTION_CREATE = 'create';

    public const ACTION_UPDATE = 'update';

    public const ACTION_DELETE = 'delete';

    public const ACTION_GET = 'get';

    /**
     * @var ResourceApiHandlerInterface[]
     */
    private $resourceHandlerCollection;

    /**
     * @var DataValidatorInterface[]
     */
    private $validatorCollection;

    /**
     * @var PersistenceInterface
     */
    private $persistence;

    /**
     * ResourceApi constructor.
     * @param PersistenceInterface $persistence
     * @param array $resourceHandlerCollection
     * @param array $validatorCollection
     */
    public function __construct(PersistenceInterface $persistence, array $resourceHandlerCollection, array $validatorCollection)
    {
        $this->validatorCollection = $validatorCollection;
        $this->persistence = $persistence;

        foreach($resourceHandlerCollection as $type => $handler){
            $this->addResourceHandler($type, $handler);
        }

        foreach($validatorCollection as $type => $validator){
            $this->addValidator($type, $validator);
        }
    }

    /**
     * @param string $type
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     * @throws ApiException
     */
    public function create(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $this->doResourceAction(self::ACTION_CREATE, $type, $data);
    }

    /**
     * @param string $type
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     * @throws ApiException
     */
    public function update(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $this->doResourceAction(self::ACTION_UPDATE, $type, $data);
    }

    /**
     * @param string $type
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     * @throws ApiException
     */
    public function delete(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $this->doResourceAction(self::ACTION_DELETE, $type, $data);
    }

    /**
     * @param string $type
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     * @throws ApiException
     */
    public function get(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $this->doResourceAction(self::ACTION_GET, $type, $data);
    }

    /**
     * @param string $type
     * @param DataValidatorInterface $validator
     */
    private function addValidator(string $type, DataValidatorInterface $validator): void
    {
        $this->validatorCollection[$type] = $validator;
    }

    /**
     * @param ResourceApiHandlerInterface $handler
     */
    private function addResourceHandler(string $type, ResourceApiHandlerInterface $handler): void
    {
        $this->resourceHandlerCollection[$type] = $handler;
    }

    /**
     * @param string $type
     * @return ResourceApiHandlerInterface
     * @throws ApiException
     */
    private function getResourceHandler(string $type): ResourceApiHandlerInterface
    {
        if(!isset($this->resourceHandlerCollection[$type])){
            throw new ApiException(sprintf('No handler for type %s', $type));
        }

        return $this->resourceHandlerCollection[$type];
    }

    /**
     * @param string $type
     * @return DataValidatorInterface
     */
    private function getDataValidator(string $type): DataValidatorInterface
    {
        return $this->validatorCollection[$type] ?? new NullDataValidator();
    }

    /**
     * @param string $action
     * @param string $type
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     * @throws ApiException
     */
    private function doResourceAction(string $action, string $type, ApiDataInterface $data): ApiDataInterface
    {
        try{
            $handler = $this->getResourceHandler($type);
            $validator = $this->getDataValidator($type);

            $validator->validate($action, $data);
            $handeled = $handler->create($data);

            $result = call_user_func_array([$this->persistence, $action], [$type, $handeled]);
        }
        catch(\Exception $e){
            throw new ApiException(sprintf('An error occured: %s', $e->getMessage()), $e->getCode(), $e);
        }

        return $result;
    }
}