<?php

namespace SclZfCartTests\Service;

use SclZfCart\Service\CartFactory;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-08 at 17:05:30.
 */
class CartFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CartFactory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new CartFactory;
    }

    /**
     * @covers SclZfCart\Service\CartFactory::createService
     * @todo   Implement testCreateService().
     */
    public function testCreateService()
    {
        $cart = $this->getMock('SclZfCart\Cart');

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $storage = $this->getMockBuilder('SclZfCart\Storage\CartStorage')
            ->disableOriginalConstructor()
            ->getMock();

        $session = new \stdClass();
        $session->cartId = 43;

        $application = $this->getMockBuilder('Zend\Mvc\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $eventManager = $this->getMock('Zend\EventManager\EventManagerInterface');

        $serviceLocator->expects($this->at(0))
            ->method('get')
            ->with($this->equalTo('SclZfCart\CartObject'))
            ->will($this->returnValue($cart));

        $serviceLocator->expects($this->at(1))
            ->method('get')
            ->with($this->equalTo('SclZfCart\Storage\CartStorage'))
            ->will($this->returnValue($storage));

        $serviceLocator->expects($this->at(2))
            ->method('get')
            ->with($this->equalTo('SclZfCart\Session'))
            ->will($this->returnValue($session));

        $storage->expects($this->once())
            ->method('load')
            ->with($this->equalTo($session->cartId), $this->equalTo($cart));

        $serviceLocator->expects($this->at(3))
            ->method('get')
            ->with($this->equalTo('Application'))
            ->will($this->returnValue($application));

        $application->expects($this->once())
            ->method('getEventManager')
            ->will($this->returnValue($eventManager));

        $eventManager->expects($this->once())
            ->method('attach')
            ->with($this->equalTo(\Zend\Mvc\MvcEvent::EVENT_FINISH));

        $this->assertEquals($cart, $this->object->createService($serviceLocator));
    }
}
