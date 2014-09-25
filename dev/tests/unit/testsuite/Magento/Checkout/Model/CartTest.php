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

namespace Magento\Checkout\Model;

use Magento\TestFramework\Helper\ObjectManager as ObjectManagerHelper;

/**
 * Class CartTest
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Magento\Checkout\Model\Cart */
    protected $cart;

    /** @var ObjectManagerHelper */
    protected $objectManagerHelper;

    /** @var \Magento\Checkout\Model\Session|\PHPUnit_Framework_MockObject_MockObject */
    protected $checkoutSessionMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $customerSessionMock;

    /** @var \Magento\CatalogInventory\Service\V1\StockItemService|\PHPUnit_Framework_MockObject_MockObject */
    protected $stockItemMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $scopeConfigMock;

    protected function setUp()
    {
        $this->checkoutSessionMock = $this->getMock('Magento\Checkout\Model\Session', [], [], '', false);
        $this->customerSessionMock = $this->getMock('Magento\Customer\Model\Session', [], [], '', false);
        $this->scopeConfigMock = $this->getMock('\Magento\Framework\App\Config\ScopeConfigInterface');
        $this->stockItemMock = $this->getMock(
            'Magento\CatalogInventory\Service\V1\StockItemService',
            [],
            [],
            '',
            false
        );

        $this->objectManagerHelper = new ObjectManagerHelper($this);
        $this->cart = $this->objectManagerHelper->getObject(
            'Magento\Checkout\Model\Cart',
            [
                'scopeConfig' => $this->scopeConfigMock,
                'checkoutSession' => $this->checkoutSessionMock,
                'stockItemService' => $this->stockItemMock,
                'customerSession' => $this->customerSessionMock,
            ]
        );
    }

    public function testSuggestItemsQty()
    {
        $data = [[], ['qty' => -2], ['qty' => 3], ['qty' => 3.5], ['qty' => 5], ['qty' => 4]];

        $quote = $this->getMock('Magento\Sales\Model\Quote', [], [], '', false);
        $quote->expects($this->any())
            ->method('getItemById')
            ->will($this->returnValueMap([
                [2, $this->prepareQuoteItemMock(2)],
                [3, $this->prepareQuoteItemMock(3)],
                [4, $this->prepareQuoteItemMock(4)],
                [5, $this->prepareQuoteItemMock(5)],
            ]));

        $this->stockItemMock->expects($this->any())
            ->method('suggestQty')
            ->will($this->returnValueMap([[4, 3., 3.], [5, 3.5, 3.5]]));

        $this->checkoutSessionMock->expects($this->once())
            ->method('getQuote')
            ->will($this->returnValue($quote));

        $this->assertSame(
            [
                [],
                ['qty' => -2],
                ['qty' => 3., 'before_suggest_qty' => 3.],
                ['qty' => 3.5, 'before_suggest_qty' => 3.5],
                ['qty' => 5],
                ['qty' => 4],
            ],
            $this->cart->suggestItemsQty($data)
        );
    }

    /**
     * @param int|bool $itemId
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function prepareQuoteItemMock($itemId)
    {
        switch ($itemId) {
            case 2:
                $product = $this->getMock('Magento\Catalog\Model\Product', [], [], '', false);
                $product->expects($this->once())
                    ->method('getId')
                    ->will($this->returnValue(4));
                break;
            case 3:
                $product = $this->getMock('Magento\Catalog\Model\Product', [], [], '', false);
                $product->expects($this->once())
                    ->method('getId')
                    ->will($this->returnValue(5));
                break;
            case 4:
                $product = false;
                break;
            default:
                return false;
        }

        $quoteItem = $this->getMock('Magento\Sales\Model\Quote\Item', [], [], '', false);
        $quoteItem->expects($this->once())
            ->method('getProduct')
            ->will($this->returnValue($product));
        return $quoteItem;
    }

    /**
     * @param boolean $useQty
     * @dataProvider useQtyDataProvider
     */
    public function testGetSummaryQty($useQty)
    {
        $quoteId = 1;
        $itemsCount = 1;
        $quoteMock = $this->getMock(
            'Magento\Sales\Model\Quote',
            ['getItemsCount', 'getItemsQty', '__wakeup'],
            [],
            '',
            false
        );

        $this->checkoutSessionMock->expects($this->any())->method('getQuote')->will($this->returnValue($quoteMock));
        $this->checkoutSessionMock->expects($this->at(2))->method('getQuoteId')->will($this->returnValue($quoteId));
        $this->customerSessionMock->expects($this->any())->method('isLoggedIn')->will($this->returnValue(true));

        $this->scopeConfigMock->expects($this->once())->method('getValue')
            ->with('checkout/cart_link/use_qty', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
            ->will($this->returnValue($useQty));

        $qtyMethodName = ($useQty) ? 'getItemsQty' : 'getItemsCount';
        $quoteMock->expects($this->once())->method($qtyMethodName)->will($this->returnValue($itemsCount));

        $this->assertEquals($itemsCount, $this->cart->getSummaryQty());
    }

    public function useQtyDataProvider()
    {
        return [
            ['useQty' => true],
            ['useQty' => false]
        ];
    }
}
