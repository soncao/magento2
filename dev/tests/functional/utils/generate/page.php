<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
require_once dirname(__DIR__) . '/' . 'bootstrap.php';
$objectManager->create('Mtf\Util\Generate\Page')->launch();
\Mtf\Util\Generate\GenerateResult::displayResults();
