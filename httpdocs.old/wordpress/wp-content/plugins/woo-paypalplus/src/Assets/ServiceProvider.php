<?php
/*
 * This file is part of the PayPal PLUS for WooCommerce package.
 */

namespace WCPayPalPlus\Assets;

use WCPayPalPlus\ExpressCheckoutGateway\Gateway as ExpressCheckoutGateway;
use WCPayPalPlus\PlusGateway\Gateway as PlusGateway;
use WCPayPalPlus\PluginProperties;
use WCPayPalPlus\Service\BootstrappableServiceProvider;
use WCPayPalPlus\Service\Container;
use WCPayPalPlus\Setting\ExpressCheckoutStorable;

class ServiceProvider implements BootstrappableServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register(Container $container)
    {
        $container[AssetManager::class] = function (Container $container) {
            return new AssetManager(
                $container[PluginProperties::class],
                $container[SmartButtonArguments::class]
            );
        };
        $container[SmartButtonArguments::class] = function (Container $container) {
            return new SmartButtonArguments(
                $container[ExpressCheckoutStorable::class]
            );
        };
        $container[PayPalAssetManager::class] = function (Container $container) {
            return new PayPalAssetManager(
                $container[ExpressCheckoutGateway::class],
                $container[PlusGateway::class]
            );
        };
    }

    /**
     * @inheritdoc
     */
    public function bootstrap(Container $container)
    {
        if (is_admin()) {
            add_action(
                'admin_enqueue_scripts',
                [$container[AssetManager::class], 'enqueueAdminStyles']
            );
            add_action(
                'admin_enqueue_scripts',
                [$container[AssetManager::class], 'enqueueAdminScripts']
            );

            return;
        }

        add_action(
            'wp_enqueue_scripts',
            [$container[PayPalAssetManager::class], 'enqueueFrontEndScripts']
        );

        add_action(
            'wp_enqueue_scripts',
            [$container[AssetManager::class], 'enqueueFrontEndScripts']
        );
        add_action(
            'wp_enqueue_scripts',
            [$container[AssetManager::class], 'enqueueFrontendStyles']
        );

        add_filter(
            SmartButtonArguments::FILTER_LOCALE,
            function ($locale) {
                switch ($locale) {
                    case 'de_DE_formal':
                        $locale = 'de_DE';
                        break;
                    case 'de_CH_informal':
                        $locale = 'de_CH';
                        break;
                }

                return $locale;
            }
        );
    }
}
