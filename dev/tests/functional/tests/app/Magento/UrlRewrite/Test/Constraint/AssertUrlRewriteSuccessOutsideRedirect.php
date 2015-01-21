<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\UrlRewrite\Test\Constraint;

use Magento\UrlRewrite\Test\Fixture\UrlRewrite;
use Mtf\Client\Browser;
use Mtf\Constraint\AbstractConstraint;

/**
 * Class AssertUrlRewriteSuccessOutsideRedirect
 * Assert that outside redirect was success
 */
class AssertUrlRewriteSuccessOutsideRedirect extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that outside redirect was success
     *
     * @param UrlRewrite $urlRewrite
     * @param Browser $browser
     * @param UrlRewrite|null $initialRewrite [optional]
     * @return void
     */
    public function processAssert(UrlRewrite $urlRewrite, Browser $browser, UrlRewrite $initialRewrite = null)
    {
        $urlRequestPath = $urlRewrite->hasData('request_path')
            ? $urlRewrite->getRequestPath()
            : $initialRewrite->getRequestPath();
        $urlTargetPath = $urlRewrite->hasData('target_path')
            ? $urlRewrite->getTargetPath()
            : $initialRewrite->getTargetPath();

        $browser->open($_ENV['app_frontend_url'] . $urlRequestPath);
        $browserUrl = $browser->getUrl();

        \PHPUnit_Framework_Assert::assertEquals(
            $browserUrl,
            $urlTargetPath,
            'URL rewrite redirect false.'
            . "\nExpected: " . $urlTargetPath
            . "\nActual: " . $browserUrl
        );
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function toString()
    {
        return 'Custom outside URL rewrite redirect was success.';
    }
}
