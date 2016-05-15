<?php

namespace Hackathon\Easycheckout\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $response;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        parent::__construct($context);
        $this->response = $context->getResponse();
        $this->resultPageFactory = $resultPageFactory;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * @return mixed
     */
    protected function _getHelper()
    {
        return $this->_objectManager->get('Hackathon\Easycheckout\Helper\Data');
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if(!$this->checkoutSession->getQuote()->hasItems()) {
            $this->response->setRedirect($this->_getHelper()->getCartUrl());
        }

        return $this->resultPageFactory->create();
    }
}
