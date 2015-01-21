<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Install\Test\Constraint;

use Magento\Install\Test\Page\Install;
use Mtf\Constraint\AbstractConstraint;

/**
 * Check that PHP Version, PHP Extensions and File Permission are ok.
 */
class AssertSuccessfulReadinessCheck extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'high';
    /* end tags */

    /**
     * PHP version message.
     */
    const PHP_VERSION_MESSAGE = 'Your PHP version is correct';

    /**
     * PHP extensions message.
     */
    const PHP_EXTENSIONS_MESSAGE = 'You meet 9 out of 9 PHP extensions requirements.';

    /**
     * File permission message.
     */
    const FILE_PERMISSION_MESSAGE = 'You meet 4 out of 4 writable file permission requirements.';

    /**
     * Assert that PHP Version, PHP Extensions and File Permission are ok.
     *
     * @param Install $installPage
     * @return void
     */
    public function processAssert(Install $installPage)
    {
        \PHPUnit_Framework_Assert::assertContains(
            self::PHP_VERSION_MESSAGE,
            $installPage->getReadinessBlock()->getPhpVersionCheck(),
            'PHP version is incorrect.'
        );
        \PHPUnit_Framework_Assert::assertContains(
            self::PHP_EXTENSIONS_MESSAGE,
            $installPage->getReadinessBlock()->getPhpExtensionsCheck(),
            'PHP extensions missed.'
        );
        \PHPUnit_Framework_Assert::assertContains(
            self::FILE_PERMISSION_MESSAGE,
            $installPage->getReadinessBlock()->getFilePermissionCheck(),
            'File permissions does not meet requirements.'
        );
    }

    /**
     * Returns a string representation of successful assertion.
     *
     * @return string
     */
    public function toString()
    {
        return "PHP Version, PHP Extensions and File Permission are ok.";
    }
}
