<?php

namespace Woom\PreventOrder\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Woom\PreventOrder\Model\Config;

class PreventOrders implements ObserverInterface
{
    /**
     * @var MessageManagerInterface
     */
    private MessageManagerInterface $messageManager;

    /**
     * @var Config
     */
    private Config $config;

    public function __construct(
        MessageManagerInterface $messageManager,
        Config                  $config
    ){
        $this->messageManager = $messageManager;
        $this->config = $config;
    }

    /**
     * Redirect to home page for prevent customer orders
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($this->config->isEnabled()) {
            $this->messageManager->addErrorMessage(__('Order placement has been disabled.'));
            $observer->getControllerAction()
                ->getResponse()
                ->setRedirect('/');
        }
    }
}
