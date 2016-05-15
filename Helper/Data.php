<?php

namespace Hackathon\Easycheckout\Helper;

class Data extends \Magento\Framework\Url\Helper\Data
{
    /**
     * @return string
     */
    public function getCartUrl()
    {
        return $this->_getUrl('checkout/cart');
    }
}
