<?php

namespace Hackathon\Easycheckout\Block;

use Magento\Framework\View\Element\Template;

class Easycheckout extends Template
{
    protected $configProvider;


    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider
    )
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
        $this->configProvider = $configProvider;
    }

    public function getConfig()
    {
        return $this->configProvider->getConfig();
    }

}
