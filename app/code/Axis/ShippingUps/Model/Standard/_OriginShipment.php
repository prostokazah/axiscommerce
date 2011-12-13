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
 * @package     Axis_ShippingUps
 * @subpackage  Axis_ShippingUps_Model
 * @copyright   Copyright 2008-2011 Axis
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Axis
 * @package     Axis_ShippingUps
 * @subpackage  Axis_ShippingUps_Model
 * @author      Axis Core Team <core@axiscommerce.com>
 * @abstract
 */
class Axis_ShippingUps_Model_Standard_OriginShipment implements Axis_Config_Option_Interface
{
    /**
     *
     * @static
     * @return const array
     */
    public static function getConfigOptionsArray()
    {
        $origin = Axis::config('shipping/Ups_Standard/xmlOrigin');
        
        $originShipment = array(
            // United States Domestic Shipments
            'United States Domestic Shipments' => array(
                '01' => 'UPS Next Day Air',
                '02' => 'UPS Second Day Air',
                '03' => 'UPS Ground',
                '07' => 'UPS Worldwide Express',
                '08' => 'UPS Worldwide Expedited',
                '11' => 'UPS Standard',
                '12' => 'UPS Three-Day Select',
                '13' => 'UPS Next Day Air Saver',
                '14' => 'UPS Next Day Air Early A.M.',
                '54' => 'UPS Worldwide Express Plus',
                '59' => 'UPS Second Day Air A.M.',
                '65' => 'UPS Saver',
            ),
            // Shipments Originating in United States
            'Shipments Originating in United States' => array(
                '01' => 'UPS Next Day Air',
                '02' => 'UPS Second Day Air',
                '03' => 'UPS Ground',
                '07' => 'UPS Worldwide Express',
                '08' => 'UPS Worldwide Expedited',
                '11' => 'UPS Standard',
                '12' => 'UPS Three-Day Select',
                '14' => 'UPS Next Day Air Early A.M.',
                '54' => 'UPS Worldwide Express Plus',
                '59' => 'UPS Second Day Air A.M.',
                '65' => 'UPS Saver',
            ),
            // Shipments Originating in Canada
            'Shipments Originating in Canada' => array(
                '01' => 'UPS Express',
                '02' => 'UPS Expedited',
                '07' => 'UPS Worldwide Express',
                '08' => 'UPS Worldwide Expedited',
                '11' => 'UPS Standard',
                '12' => 'UPS Three-Day Select',
                '14' => 'UPS Express Early A.M.',
                '65' => 'UPS Saver',
            ),
            // Shipments Originating in the European Union
            'Shipments Originating in the European Union' => array(
                '07' => 'UPS Express',
                '08' => 'UPS Expedited',
                '11' => 'UPS Standard',
                '54' => 'UPS Worldwide Express PlusSM',
                '65' => 'UPS Saver',
            ),
            // Polish Domestic Shipments
            'Polish Domestic Shipments' => array(
                '07' => 'UPS Express',
                '08' => 'UPS Expedited',
                '11' => 'UPS Standard',
                '54' => 'UPS Worldwide Express Plus',
                '65' => 'UPS Saver',
                '82' => 'UPS Today Standard',
                '83' => 'UPS Today Dedicated Courrier',
                '84' => 'UPS Today Intercity',
                '85' => 'UPS Today Express',
                '86' => 'UPS Today Express Saver',
            ),
            // Puerto Rico Origin
            'Puerto Rico Origin' => array(
                '01' => 'UPS Next Day Air',
                '02' => 'UPS Second Day Air',
                '03' => 'UPS Ground',
                '07' => 'UPS Worldwide Express',
                '08' => 'UPS Worldwide Expedited',
                '14' => 'UPS Next Day Air Early A.M.',
                '54' => 'UPS Worldwide Express Plus',
                '65' => 'UPS Saver',
            ),
            // Shipments Originating in Mexico
            'Shipments Originating in Mexico' => array(
                '07' => 'UPS Express',
                '08' => 'UPS Expedited',
                '54' => 'UPS Express Plus',
                '65' => 'UPS Saver',
            ),
            // Shipments Originating in Other Countries
            'Shipments Originating in Other Countries' => array(
                '07' => 'UPS Express',
                '08' => 'UPS Worldwide Expedited',
                '11' => 'UPS Standard',
                '54' => 'UPS Worldwide Express Plus',
                '65' => 'UPS Saver')
        );
        
        
        isset($originShipment[$origin]) ?
            $originShipment[$origin] : array();
    }

    /**
     *
     * @static
     * @param string $code
     * @return string
     */
    public static function getConfigOptionName($code)
    {
        $shipments = self::getConfigOptionsArray();
        return isset($shipments[$code]) ? $shipments[$code] : '';
    }
}