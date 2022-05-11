<?php

namespace Woom\PreventOrder\Controller\Index;

use Magento\Checkout\Controller\Index\Index as CheckoutIndex;
use Magento\Framework\Controller\ResultInterface;

class Index extends CheckoutIndex
{
    /**
     * Checkout page is disabled for customer orders
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $this->messageManager->addErrorMessage(__('Order placement has been disabled.'));
        return $this->resultRedirectFactory->create()->setPath('/');
    }
}
