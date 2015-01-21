<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Block\Adminhtml\Product\Edit\Tab\Options\Type;

use Magento\Catalog\Test\Block\Adminhtml\Product\Edit\Tab\Options\AbstractOptions;
use Mtf\Client\Element;

/**
 * Form "Option dropdown" on tab product "Custom options".
 */
class DropDown extends AbstractOptions
{
    /**
     * Add button css selector.
     *
     * @var string
     */
    protected $buttonAddLocator = '[id$="_add_select_row"]';

    /**
     * Name for title column.
     *
     * @var string
     */
    protected $optionTitle = '.data-table th.col-name';

    /**
     * Fill the form.
     *
     * @param array $fields
     * @param Element $element
     * @return $this
     */
    public function fillOptions(array $fields, Element $element = null)
    {
        $this->_rootElement->find($this->optionTitle)->click();
        $this->_rootElement->find($this->buttonAddLocator)->click();
        return parent::fillOptions($fields, $element);
    }
}
