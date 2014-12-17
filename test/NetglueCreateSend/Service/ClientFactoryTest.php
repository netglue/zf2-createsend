<?php

namespace NetglueCreateSend\Service;

class ClientFactoryTest extends \Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase
{

    public function testClientRetrievableFromServiceLocator()
    {
        $locator = $this->getApplicationServiceLocator();
    }

}
