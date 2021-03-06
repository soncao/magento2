<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Controller\Adminhtml\Order\Create;


class ProcessData extends \Magento\Sales\Controller\Adminhtml\Order\Create
{
    /**
     * Process data and display index page
     *
     * @return void
     */
    public function execute()
    {
        $this->_initSession();
        $this->_processData();
        $this->_forward('index');
    }
}
