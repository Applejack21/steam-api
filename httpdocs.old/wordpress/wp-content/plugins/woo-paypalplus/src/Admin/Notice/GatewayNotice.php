<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the PayPal PLUS for WooCommerce package.
 */

namespace WCPayPalPlus\Admin\Notice;

/**
 * Class GatewayNotice
 * @package WCPayPalPlus\Admin
 */
class GatewayNotice implements Noticeable
{
    /**
     * @inheritDoc
     */
    public function type()
    {
        return Noticeable::WARNING;
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return esc_html_x(
            'Seems you have more than one PayPal gateway active. We recommend to deactivate all of them except PayPal PLUS to avoid duplicated payment options at checkout.',
            'admin-notice',
            'woo-paypalplus'
        );
    }

    /**
     * @inheritDoc
     */
    public function isDismissable()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function id()
    {
        return __CLASS__;
    }
}
