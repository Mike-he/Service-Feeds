<?php

namespace MicroServicesBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

class TestService implements IRpcService
{
    /**
     * @var string
     */
    const HELLO = 'Hello';

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function sayHello()
    {
        return static::HELLO;
    }

    /**
     * @param string $name
     * @return string
     */
    public function sayHelloName($name)
    {
        return static::HELLO . ', ' . $name;
    }
}