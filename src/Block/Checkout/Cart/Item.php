<?php

namespace Hyva\MageplazaGiftWrap\Block\Checkout\Cart;

use Mageplaza\GiftWrap\Helper\Data;
use Mageplaza\GiftWrap\Helper\Data as MageplazaGiftWrapHelper;
use Mageplaza\GiftWrap\Model\Config\Source\Type;

/**
 * Class Item
 */
class Item extends \Magento\Framework\View\Element\Template
{
    protected $mageplazaGiftWrapHelper;

    public function __construct(MageplazaGiftWrapHelper $mageplazaGiftWrapHelper, \Magento\Framework\View\Element\Template\Context $context, array $data = [])
    {
        $this->mageplazaGiftWrapHelper = $mageplazaGiftWrapHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->setTemplate('checkout/cart/item-additional.phtml');
    }

    public function getWrapData(): ?array
    {
        $mergeData = [
            'gift_message_fee' => $this->mageplazaGiftWrapHelper->getGiftMessageFee(false, false, null)
        ];
        $item = $this->getItem();
        $mpGiftWrapData = $item->getMpGiftWrapData();
        return $mpGiftWrapData !== null ? array_merge($mergeData, json_decode($mpGiftWrapData, true)) : null;
    }

    public function getPostCardData(): ?array
    {
        $item = $this->getItem();
        $postCardData = $item->getMpGiftWrapPostcardData();
        return $postCardData !== null ? json_decode($postCardData, true) : null;
    }

    public function getWraps()
    {
        return $this->mageplazaGiftWrapHelper->getWraps(\Mageplaza\GiftWrap\Model\Config\Source\WrapType::GIFT_WRAP_WRAP_TYPE) ?? [];
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return !$this->mageplazaGiftWrapHelper->isEnabled()
            || $this->mageplazaGiftWrapHelper->getGiftWrapType() === Type::ALL
            || !in_array($this->getItem()->getProduct()->getTypeId(), Data::ALLOWED_TYPE, true);
    }
}
