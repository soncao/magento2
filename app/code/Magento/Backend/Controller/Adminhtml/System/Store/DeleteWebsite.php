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
namespace Magento\Backend\Controller\Adminhtml\System\Store;

class DeleteWebsite extends \Magento\Backend\Controller\Adminhtml\System\Store
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_title->add(__('Delete Web Site'));

        $itemId = $this->getRequest()->getParam('item_id', null);
        if (!($model = $this->_objectManager->create('Magento\Store\Model\Website')->load($itemId))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $this->_redirect('adminhtml/*/');
            return;
        }
        if (!$model->isCanDelete()) {
            $this->messageManager->addError(__('This website cannot be deleted.'));
            $this->_redirect('adminhtml/*/editWebsite', array('website_id' => $itemId));
            return;
        }

        $this->_addDeletionNotice('website');

        $this->_initAction()->_addBreadcrumb(
            __('Delete Web Site'),
            __('Delete Web Site')
        )->_addContent(
            $this->_view->getLayout()->createBlock(
                'Magento\Backend\Block\System\Store\Delete'
            )->setFormActionUrl(
                $this->getUrl('adminhtml/*/deleteWebsitePost')
            )->setBackUrl(
                $this->getUrl('adminhtml/*/editWebsite', array('website_id' => $itemId))
            )->setStoreTypeTitle(
                __('Web Site')
            )->setDataObject(
                $model
            )
        );
        $this->_view->renderLayout();
    }
}
