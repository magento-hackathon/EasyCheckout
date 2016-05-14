<?php

namespace Hackathon\Easycheckout\Block;

use Magento\Framework\View\Element\Template;

class Easycheckout extends Template
{
    protected $configProvider;
    protected $customerSession;
    protected $checkoutSession;
    protected $quoteIdMaskFactory;
    protected $paymentMethodList;

    /**
     * Easycheckout constructor.
     * @param Template\Context $context
     * @param array $data
     * @param \Magento\Checkout\Model\CompositeConfigProvider $configProvider
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \Magento\Payment\Model\MethodList $paymentMethodList
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory,
        \Magento\Payment\Model\MethodList $paymentMethodList
    )
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
        $this->configProvider = $configProvider;
        $this->customerSession = $customerSession;
        $this->checkoutSession = $checkoutSession;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->paymentMethodList = $paymentMethodList;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->configProvider->getConfig();
    }

    /**
     * @return \Magento\Checkout\Model\Session
     */
    public function getCheckoutSession()
    {
        return $this->checkoutSession;
    }

    /**
     * @return string
     */
    public function getQuoteIdMask()
    {
        $quoteId = $this->getCheckoutSession()->getQuoteId();
        return $this->quoteIdMaskFactory
            ->create()
            ->load($quoteId, 'quote_id')
            ->getMaskedId();
    }

    public function getAvailablePaymentMethods()
    {
        $quote = $this->getCheckoutSession()->getQuote();
        return $this->paymentMethodList->getAvailableMethods($quote);
    }
}
