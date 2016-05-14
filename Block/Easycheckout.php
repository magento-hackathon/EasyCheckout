<?php

namespace Hackathon\Easycheckout\Block;

use Magento\Framework\View\Element\Template;

class Easycheckout extends Template
{
    protected $configProvider;
    protected $customerSession;
    protected $checkoutSession;
    /**
     * @var \Magento\Quote\Model\QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;


    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
    )
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
        $this->configProvider = $configProvider;
        $this->customerSession = $customerSession;
        $this->checkoutSession = $checkoutSession;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    public function getConfig()
    {
        return $this->configProvider->getConfig();
    }

    public function getCheckoutSession()
    {
        return $this->checkoutSession;
    }

    public function getQuoteIdMask()
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($this->getCheckoutSession()->getQuoteId(), 'quote_id')->getMaskedId();
        return $quoteIdMask;
    }
}
