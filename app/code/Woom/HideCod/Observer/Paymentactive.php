<?php

namespace Woom\HideCod\Observer;

use Magento\Checkout\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Model\Method\AbstractMethod;

class Paymentactive implements ObserverInterface
{
    /**
     * @var Session $checkoutSession
     */
    private Session $checkoutSession;

    public function __construct(Session $checkoutSession)
    {
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Does not show Cashondelivery method if the first letter of the customer name is "P"
     *
     * @param Observer $observer
     * @return void
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        /** @var AbstractMethod $method */
        $method = $observer->getEvent()->getMethodInstance();
        $methodCode = $method->getCode();
        $result = $observer->getEvent()->getResult();

        $customerName = $this->checkoutSession->getQuote()->getBillingAddress()->getFirstname();

        if ($customerName != NULL && ($customerName[0] == "P" || $customerName[0] == "p"))
        {
            if ($methodCode == "cashondelivery")
            {
                $result->setData('is_available', false);
            }
        }
    }
}
