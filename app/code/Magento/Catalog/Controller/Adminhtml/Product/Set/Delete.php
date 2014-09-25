<?php
/**
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Catalog\Controller\Adminhtml\Product\Set;

class Delete extends \Magento\Catalog\Controller\Adminhtml\Product\Set
{
    /**
     * @return void
     */
    public function execute()
    {
        $setId = $this->getRequest()->getParam('id');
        try {
            $this->_objectManager->create('Magento\Eav\Model\Entity\Attribute\Set')->setId($setId)->delete();

            $this->messageManager->addSuccess(__('The attribute set has been removed.'));
            $this->getResponse()->setRedirect($this->getUrl('catalog/*/'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__('An error occurred while deleting this set.'));
            $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl($this->getUrl('*')));
        }
    }
}
