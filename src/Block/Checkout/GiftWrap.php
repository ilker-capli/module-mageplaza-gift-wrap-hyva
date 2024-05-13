<?php

namespace Hyva\MageplazaGiftWrap\Block\Checkout;

/**
 * Class GiftWrap
 */
class GiftWrap extends \Magento\Framework\View\Element\Template
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->setTemplate('checkout/gift-wrap.phtml');
    }

    /**
     * @return string
     */
    public function _toHtml()
    {
        return parent::_toHtml();
    }
}
