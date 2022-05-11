<?php

namespace Woom\PreventOrder\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const PREVENT_ORDER_IS_ENABLED = "sales/general/prevent_order";

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if customer orders is enabled in admin config
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::PREVENT_ORDER_IS_ENABLED
        );
    }
}
