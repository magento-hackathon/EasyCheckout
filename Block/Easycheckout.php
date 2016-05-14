<?php

namespace Hackathon\Easycheckout\Block;

use Magento\Framework\View\Element\Template;

class Easycheckout extends Template
{

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

}
