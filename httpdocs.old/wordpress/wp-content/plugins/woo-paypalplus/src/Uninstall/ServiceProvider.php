<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the PayPal PLUS for WooCommerce package.
 *
 * (c) Inpsyde GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WCPayPalPlus\Uninstall;

use WCPayPalPlus\Http\PayPalAssetsCache\ResourceDictionary;
use WCPayPalPlus\Service\Container;
use wpdb;

/**
 * Class ServiceProvider
 * @package WCPayPalPlus\Deactivation
 */
class ServiceProvider implements \WCPayPalPlus\Service\ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register(Container $container)
    {
        $container->share(
            Uninstaller::class,
            function (Container $container) {
                return new Uninstaller(
                    $container->get(wpdb::class),
                    $container->get('wp_filesystem')
                );
            }
        );
    }
}
