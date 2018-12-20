<?php

use PHPassword\Api\ApiDataInterface;
use PHPassword\Api\ApiException;
use PHPassword\Api\ResourceApi;
use PHPassword\Api\TestEmptyApiData;
use PHPassword\Api\TestEmptyPersistence;
use PHPassword\Api\TestEntity;
use PHPassword\Api\TestNegativeHandler;
use PHPassword\Api\TestNegativeValidator;
use PHPassword\Api\TestPositiveHandler;
use PHPassword\Api\TestPositiveValidator;
use PHPUnit\Framework\TestCase;

class ResourceApiTest extends TestCase
{
    /**
     * @var ResourceApi
     */
    private $api;

    public function setUp(): void
    {
        $handler = [TestEntity::class => new TestPositiveHandler()];
        $validator = [TestEntity::class => new TestPositiveValidator()];
        $this->api = new ResourceApi(new TestEmptyPersistence(), $handler, $validator);
    }

    /**
     * @throws \Exception
     */
    public function testIntegration(): void
    {
        $result = $this->api->create(TestEntity::class, new TestEmptyApiData());
        $this->assertInstanceOf(ApiDataInterface::class, $result);

        $result = $this->api->update(TestEntity::class, new TestEmptyApiData());
        $this->assertInstanceOf(ApiDataInterface::class, $result);

        $result = $this->api->delete(TestEntity::class, new TestEmptyApiData());
        $this->assertInstanceOf(ApiDataInterface::class, $result);

        $result = $this->api->get(TestEntity::class, new TestEmptyApiData());
        $this->assertInstanceOf(ApiDataInterface::class, $result);
    }

    /**
     * @throws \Exception
     */
    public function testCreateDeleteUpdateGetFailHandler()
    {
        $methodsUnchecked = ['create', 'update', 'delete', 'get'];
        foreach($methodsUnchecked as $i => $method) {
            try {
                $api = new ResourceApi(new TestEmptyPersistence(), [TestEntity::class => new TestNegativeHandler()], []);
                call_user_func_array([$api, $method], [TestEntity::class, new TestEmptyApiData()]);
            }
            catch(ApiException $e){
                unset($methodsUnchecked[$i]);
            }
        }

        $this->assertSame(0, count($methodsUnchecked));
    }

    /**
     * @throws \Exception
     */
    public function testCreateDeleteUpdateGetFailValidator()
    {
        $methodsUnchecked = ['create', 'update', 'delete', 'get'];
        foreach($methodsUnchecked as $i => $method) {
            try {
                $api = new ResourceApi(
                    new TestEmptyPersistence(),
                    [TestEntity::class => new TestPositiveHandler()],
                    [TestEntity::class => new TestNegativeValidator()]
                );

                call_user_func_array([$api, $method], [TestEntity::class, new TestEmptyApiData()]);
            }
            catch(ApiException $e){
                unset($methodsUnchecked[$i]);
            }
        }

        $this->assertSame(0, count($methodsUnchecked));
    }
}