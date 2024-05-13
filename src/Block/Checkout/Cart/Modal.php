<?php

namespace Hyva\MageplazaGiftWrap\Block\Checkout\Cart;

use Mageplaza\GiftWrap\Helper\Data as MageplazaGiftWrapHelper;

/**
 * Class Modal
 */
class Modal extends \Magento\Framework\View\Element\Template
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
        $this->setTemplate('checkout/cart/modal.phtml');
    }

    public function getWraps()
    {
        return $this->mageplazaGiftWrapHelper->getWraps(\Mageplaza\GiftWrap\Model\Config\Source\WrapType::GIFT_WRAP_WRAP_TYPE) ?? [];
    }

    public function getGiftMessageFee()
    {
        return $this->mageplazaGiftWrapHelper->getGiftMessageFee(false, false, null);
    }
}
