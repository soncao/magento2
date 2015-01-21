<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Ui\Component\Layout;

use Magento\Ui\Component\AbstractView;

/**
 * Class Group
 */
class Group extends AbstractView
{
    /**
     * @return string
     */
    public function getIsRequired()
    {
        return $this->getData('required') ? 'required' : '';
    }
}
