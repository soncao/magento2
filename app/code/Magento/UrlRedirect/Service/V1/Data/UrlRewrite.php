<?php
/**
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
namespace Magento\UrlRedirect\Service\V1\Data;

use Magento\Framework\Service\Data\AbstractExtensibleObject;

/**
 * Data abstract class for url storage
 */
class UrlRewrite extends AbstractExtensibleObject
{
    /**#@+
     * Value object attribute names
     */
    const ENTITY_ID = 'entity_id';
    const ENTITY_TYPE = 'entity_type';
    const REQUEST_PATH = 'request_path';
    const TARGET_PATH = 'target_path';
    const STORE_ID = 'store_id';
    const REDIRECT_TYPE = 'redirect_type';
    const DESCRIPTION = 'description';
    /**#@-*/

    /**
     * Get data by key
     *
     * @param string $key
     * @return mixed|null
     */
    public function getByKey($key)
    {
        return $this->_get($key);
    }

    /**
     * @return int
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * @return int
     */
    public function getEntityType()
    {
        return $this->_get(self::ENTITY_TYPE);
    }

    /**
     * @return string
     */
    public function getRequestPath()
    {
        return $this->_get(self::REQUEST_PATH);
    }

    /**
     * @return string
     */
    public function getTargetPath()
    {
        return $this->_get(self::TARGET_PATH);
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->_get(self::STORE_ID);
    }

    /**
     * @return string
     */
    public function getRedirectType()
    {
        return $this->_get(self::REDIRECT_TYPE);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }
}
