<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Core\Model\App;

class EmulationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Core\Model\App\Emulation
     */
    protected $_model;

    /**
     * @covers \Magento\Core\Model\App\Emulation::startEnvironmentEmulation
     * @covers \Magento\Core\Model\App\Emulation::stopEnvironmentEmulation
     */
    public function testEnvironmentEmulation()
    {
        $this->_model = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
            ->create('Magento\Core\Model\App\Emulation');
        \Magento\TestFramework\Helper\Bootstrap::getInstance()
            ->loadArea(\Magento\Backend\App\Area\FrontNameResolver::AREA_CODE);
        $design = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
            ->get('Magento\Framework\View\DesignInterface');

        $this->_model->startEnvironmentEmulation(1);
        $this->_model->stopEnvironmentEmulation();
        $this->assertEquals(\Magento\Backend\App\Area\FrontNameResolver::AREA_CODE, $design->getArea());
    }
}
