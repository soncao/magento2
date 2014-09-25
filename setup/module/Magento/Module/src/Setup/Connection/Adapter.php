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
namespace Magento\Module\Setup\Connection;

use Magento\Framework\DB\Adapter\Pdo\Mysql;

class Adapter implements AdapterInterface
{
    /**
     * Get connection
     *
     * @param array $config
     * @return \Magento\Framework\DB\Adapter\AdapterInterface|null
     */
    public function getConnection(array $config = array())
    {
        return new Mysql(
            [
                'driver'         => "Pdo",
                'dsn'            => "mysql:dbname=" . $config['db_name'] . ";host=" . $config['db_host'],
                'username'       => $config['db_user'],
                'password'       => isset($config['db_pass']) ? $config['db_pass'] : null,
                'driver_options' => [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]
            ]
        );
    }
}
