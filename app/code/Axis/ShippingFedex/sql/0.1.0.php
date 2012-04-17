<?php
/**
 * Axis
 *
 * This file is part of Axis.
 *
 * Axis is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Axis is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Axis.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category    Axis
 * @package     Axis_ShippingFedex
 * @copyright   Copyright 2008-2011 Axis
 * @license     GNU Public License V3.0
 */

class Axis_ShippingFedex_Upgrade_0_1_0 extends Axis_Core_Model_Migration_Abstract
{
    protected $_version = '0.1.0';
    protected $_info = 'install';

    public function up()
    {
        $installer = $this->getInstaller();

        Axis::single('core/config_builder')
            ->container('shipping', 'Shipping Methods')
                ->setTranslation('Axis_Admin')
                ->container('Fedex_Standard', 'Fedex')
                    ->setTranslation('Axis_ShippingFedex')
                    ->option('enabled', 'Enabled')
                        ->setType('radio')
                        ->setModel('core/option_boolean')
                        ->setTranslation('Axis_Core')
                    ->option('geozone', 'Allowed Shipping Zone', '1')
                        ->setType('select')
                        ->setDescription('Shipping method will be available only for selected zone')
                        ->setModel('location/option_geozone')
                        ->setTranslation('Axis_Admin')
                    ->option('taxBasis', 'Tax Basis')
                        ->setType('select')
                        ->setDescription('Address that will be used for tax calculation')
                        ->setModel('tax/option_basis')
                        ->setTranslation('Axis_Tax')
                    ->option('taxClass', 'Tax Class')
                        ->setType('select')
                        ->setDescription('Tax class that will be used for tax calculation')
                        ->setModel('tax/option_class')
                        ->setTranslation('Axis_Tax')
                    ->option('sortOrder', 'Sort Order')
                        ->setTranslation('Axis_Core')
                    ->option('payments', 'Disallowed Payments')
                        ->setType('multiple')
                        ->setDescription('Selected payment methods will be not available with this shipping method')
                        ->setModel('checkout/option_payment')
                        ->setTranslation('Axis_Admin')
                    ->option('title', 'Title', 'Fedex Express')
                    ->option('account', 'Account Id')
                        ->setModel('core/option_crypt')
                    ->option('package', 'Package', 'YOURPACKAGING')
                        ->setType('select')
                        ->setModel('shippingFedex/option_standard_package')
                    ->option('dropoff', 'Dropoff', 'REGULARPICKUP')
                        ->setType('select')
                        ->setModel('shippingFedex/option_standard_pickup')
                    ->option('allowedTypes', 'Allowed methods', 'FEDEXGROUND')
                        ->setType('multiple')
                        ->setModel('shippingFedex/option_standard_service')
                    ->option('measure', 'UPS Weight Unit', 'LBS')
                        ->setType('select')
                        ->setDescription('LBS or KGS')
                        ->setModel('shippingFedex/option_standard_measure')
                    ->option('residenceDelivery', 'Residential Delivery')
                        ->setType('radio')
                        ->setModel('core/option_boolean')
                    ->option('gateway', 'Fedex Gateway Url', 'https://gateway.fedex.com/GatewayDC')
                    ->option('handling', 'Handling Fee')

            ->section('/');
    }

    public function down()
    {
        //Axis::single('core/config_value')->remove('shipping/Fedex_Express');
        //Axis::single('core/config_field')->remove('shipping/Fedex_Express');
        //Axis::single('core/config_value')->remove('shipping/Fedex_Ground');
        //Axis::single('core/config_field')->remove('shipping/Fedex_Ground');

        Axis::single('core/config_value')->remove('shipping/Fedex_Standard');
        Axis::single('core/config_field')->remove('shipping/Fedex_Standard');
    }
}