<?php

namespace Woom\PreventOrder\Plugin;

use Magento\Checkout\Controller\Index\Index as Subject;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory as ResultRedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Woom\PreventOrder\Model\Config;

class PreventCustomerToOrder
{
    /**
     * @var MessageManagerInterface
     */
    private MessageManagerInterface $messageManager;

    /**
     * @var ResultRedirectFactory
     */
    private ResultRedirectFactory $resultRedirectFactory;

    /**
     * @var Config
     */
    private Config $config;

    public function __construct(
        MessageManagerInterface $messageManager,
        ResultRedirectFactory $resultRedirectFactory,
        Config $config
    ){
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->config = $config;
    }

    /**
     * Checkout page redirect to home page
     *
     * @param Subject $subject
     * @param \Closure $proceed
     * @return ResultInterface
     */
    public function aroundExecute(Subject $subject, \Closure $proceed)
    {
        if (!$this->config->isEnabled())
        {
            return $proceed();
        }
        $this->messageManager->addErrorMessage(__('Order placement has been disabled.'));
        return $this->resultRedirectFactory->create()->setPath('/');
    }
}

/**
 *
 * da radi plugin u di.xml pod type postaviti name="Magento\Checkout\Controller\Index\Index"
 * inace radi s observer-om
 *
 */
