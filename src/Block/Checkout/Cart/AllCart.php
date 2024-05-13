<?php

namespace Hyva\MageplazaGiftWrap\Block\Checkout\Cart;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Mageplaza\GiftWrap\Api\Data\WrapDetailsInterface as WrapItf;
use Mageplaza\GiftWrap\Helper\Data;
use Mageplaza\GiftWrap\Helper\Data as MageplazaGiftWrapHelper;
use Mageplaza\GiftWrap\Model\Config\Source\Type;

/**
 * Class AllCart
 */
class AllCart extends Item
{
    protected $checkoutSession;

    public function __construct(CheckoutSession $checkoutSession, MageplazaGiftWrapHelper $mageplazaGiftWrapHelper, \Magento\Framework\View\Element\Template\Context $context, array $data = [])
    {
        parent::__construct($mageplazaGiftWrapHelper, $context, $data);
        $this->checkoutSession = $checkoutSession;
    }


    /**
     * @return void
     */
    protected function _construct()
    {
        $this->setTemplate('checkout/cart/all-cart.phtml');
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return !$this->mageplazaGiftWrapHelper->isEnabled()
            || $this->mageplazaGiftWrapHelper->getGiftWrapType() === Type::ITEM;
    }

    /**
     * @param string $wrapDataType
     *
     * @return mixed|string|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getSavedWrap($wrapDataType)
    {
        foreach ($this->checkoutSession->getQuote()->getAllVisibleItems() as $item) {
            $data = Data::jsonDecode($item->getData($wrapDataType));

            if (empty($data[WrapItf::ALL_CART])
                || (!empty($data[WrapItf::ALL_CART]) && !$this->mageplazaGiftWrapHelper->isShowAllCart())) {
                continue;
            }

            $mergeData = [
                'gift_message_fee' => $this->mageplazaGiftWrapHelper->getGiftMessageFee(false, false, null)
            ];

            $mpGiftWrapData = $item->getData($wrapDataType);

            return $mpGiftWrapData !== null ? array_merge($mergeData, json_decode($mpGiftWrapData, true)) : null;
        }

        return [];
    }
}
