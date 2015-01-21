<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\CheckoutAgreements\Controller\Adminhtml\Agreement;

class Save extends \Magento\CheckoutAgreements\Controller\Adminhtml\Agreement
{
    /**
     * @return void
     */
    public function execute()
    {
        $postData = $this->getRequest()->getPost();
        if ($postData) {
            $model = $this->_objectManager->get('Magento\CheckoutAgreements\Model\Agreement');
            $model->setData($postData);

            try {
                $validationResult = $model->validateData(new \Magento\Framework\Object($postData));
                if ($validationResult !== true) {
                    foreach ($validationResult as $message) {
                        $this->messageManager->addError($message);
                    }
                } else {
                    $model->save();
                    $this->messageManager->addSuccess(__('The condition has been saved.'));
                    $this->_redirect('checkout/*/');
                    return;
                }
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Something went wrong while saving this condition.'));
            }

            $this->_objectManager->get('Magento\Backend\Model\Session')->setAgreementData($postData);
            $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl($this->getUrl('*')));
        }
    }
}
