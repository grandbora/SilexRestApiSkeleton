<?php

namespace Tests\Provider\Service\Model;

use Provider\Service\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase {

    public function testConstructor() {

        $user = new User();
        $this->assertInstanceOf('Provider\Service\Model\User', $user);
        $this->assertNull($user->id);
        $this->assertNull($user->fbId);
        $this->assertNull($user->position);
        $this->assertNull($user->type);
    }

    public function testConstructorWithId() {

        $userMock = $this->getMockBuilder('Provider\Service\Model\User')
                ->setMethods(array('load'))
                ->getMock();

        $userMock->expects($this->once())
                ->method('load');

        $userMock->__construct(null, 1);
    }

    public function testConstructorWithApp() {

        $userMock = $this->getMockBuilder('Provider\Service\Model\User')
                ->setMethods(array('load'))
                ->getMock();

        $userMock->expects($this->never())
                ->method('load');

        $userMock->__construct(array('db' => null));
    }

    public function testConstructorWithAppAndId() {

        $daoMock = $this->getMockBuilder('Provider\Service\Dao\User')
                ->disableOriginalConstructor()
                ->setMethods(array('load'))
                ->getMock();

        $daoMock->expects($this->once())
                ->method('load')
                ->will($this->returnValue(array('id' => '444', 'fbId' => '555', 'type' => 'typeTest', 'position' => 'positionVal')));

        $userMock = $this->getMockBuilder('Provider\Service\Model\User')
                ->setMethods(array('getDao'))
                ->getMock();

        $userMock->expects($this->once())
                ->method('getDao')
                ->will($this->returnValue($daoMock));


        $userMock->__construct(array('db' => null), 1);

        $this->assertEquals('444', $userMock->id);
        $this->assertEquals('555', $userMock->fbId, 'fbId do not match');
        $this->assertEquals('typeTest', $userMock->type);
        $this->assertEquals('positionVal', $userMock->position);
    }

    /**
     * @expectedException        Symfony\Component\Routing\Exception\ResourceNotFoundException
     * @expectedExceptionMessage 
     */
    public function testConstructorWithAppAndIdExpectException() {

        $daoMock = $this->getMockBuilder('Provider\Service\Dao\User')
                ->disableOriginalConstructor()
                ->setMethods(array('load'))
                ->getMock();

        $daoMock->expects($this->once())
                ->method('load')
                ->will($this->returnValue(false));

        $userMock = $this->getMockBuilder('Provider\Service\Model\User')
                ->setMethods(array('getDao'))
                ->getMock();

        $userMock->expects($this->once())
                ->method('getDao')
                ->will($this->returnValue($daoMock));

        $userMock->__construct(array('db' => null), 1);
    }

}