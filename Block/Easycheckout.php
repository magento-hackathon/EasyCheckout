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
    protected $objectManager;
    protected $storeManager;

    /**
     * Easycheckout constructor.
     * @param Template\Context $context
     * @param array $data
     * @param \Magento\Checkout\Model\CompositeConfigProvider $configProvider
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \Magento\Payment\Model\MethodList $paymentMethodList
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory,
        \Magento\Payment\Model\MethodList $paymentMethodList,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
        $this->configProvider = $configProvider;
        $this->customerSession = $customerSession;
        $this->checkoutSession = $checkoutSession;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->paymentMethodList = $paymentMethodList;
        $this->objectManager = $objectManager;
        $this->storeManager = $storeManager;
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

    public function getDirectoryHelper()
    {
        return $this->objectManager->get('Magento\Directory\Helper\Data');
    }

    public function getCountries()
    {
        $store = $this->storeManager->getStore();
        return $this->getDirectoryHelper()->getCountryCollection($store);
    }

    public function getAvailablePaymentMethods()
    {
        $quote = $this->getCheckoutSession()->getQuote();
        return $this->paymentMethodList->getAvailableMethods($quote);
    }
}
