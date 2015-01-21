<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Tax\Controller\Adminhtml\Tax;

class AjaxDelete extends \Magento\Tax\Controller\Adminhtml\Tax
{
    /**
     * Delete Tax Class via AJAX
     *
     * @return void
     */
    public function execute()
    {
        $classId = (int)$this->getRequest()->getParam('class_id');
        try {
            $this->taxClassRepository->deleteById($classId);
            $responseContent = $this->_objectManager->get(
                'Magento\Core\Helper\Data'
            )->jsonEncode(
                ['success' => true, 'error_message' => '']
            );
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $responseContent = $this->_objectManager->get(
                'Magento\Core\Helper\Data'
            )->jsonEncode(
                ['success' => false, 'error_message' => $e->getMessage()]
            );
        } catch (\Exception $e) {
            $responseContent = $this->_objectManager->get(
                'Magento\Core\Helper\Data'
            )->jsonEncode(
                ['success' => false, 'error_message' => __('Something went wrong deleting this tax class.')]
            );
        }
        $this->getResponse()->representJson($responseContent);
    }
}
