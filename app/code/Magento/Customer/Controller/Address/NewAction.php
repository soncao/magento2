<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Controller\Address;

class NewAction extends \Magento\Customer\Controller\Address
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_forward('form');
    }
}
