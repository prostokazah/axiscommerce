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
 * @package     Axis_Account
 * @subpackage  Axis_Account_Model
 * @copyright   Copyright 2008-2012 Axis
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Axis
 * @package     Axis_Account
 * @subpackage  Axis_Account_Model
 * @author      Axis Core Team <core@axiscommerce.com>
 */
class Axis_Account_Model_Form_Signup extends Axis_Form
{
    protected $_translatorModule = 'account';

    protected $_eventPrefix = 'account_form_signup';

    public function __construct($options = array())
    {
        $default = array(
            'id' => 'form-signup',
            'action' => Zend_Controller_Front::getInstance()->getBaseUrl()
                 . Axis_Locale::getLanguageUrl() . '/account/auth/register'
        );
        $default = array_merge($default, $options);

        parent::__construct($default);
    }

    public function init()
    {
        $this->addElement('text', 'email', array(
            'required'  => true,
            'label'     => 'Email',
            'class'     => 'input-text required email',
            'description' => 'Email will be used to login into your account',
            'validators' => array(
                'EmailAddress',
                new Axis_Validate_Exists(
                    Axis::single('account/customer'), 'email', 'site_id = ' . Axis::getSiteId()
                )
            )
        ));

        $this->addElement('password', 'password', array(
            'required' => true,
            'label'    => 'Password',
            'class'    => 'input-text required password',
            'validators' => array(
                'NotEmpty',
                new Axis_Validate_PasswordConfirmation()
            )
        ));
        $this->addElement('password', 'password_confirm', array(
            'required' => true,
            'label'    => 'Confirm Password',
            'class'    => 'input-text required password'
        ));

        $this->addElement('text', 'firstname', array(
            'required' => true,
            'label' => 'Firstname',
            'class' => 'input-text required'
        ));
        $this->addElement('text', 'lastname', array(
            'required' => true,
            'label' => 'Lastname',
            'class' => 'input-text required'
        ));

        $this->addDisplayGroup(
            array('email', 'password', 'password_confirm', 'firstname', 'lastname'),
            'login',
            array('legend' => 'General information')
        );

        $rows = Axis::single('account/customer_field')->getFields();
        $groupsFields = array();
        foreach ($rows as $row) {
            $field = 'field_' . $row['id'];
            $config = array(
                'id'       => 'field_' . $row['name'],
                'required' => (boolean) $row['required'],
                'label'    => $row['field_label'],
                'class'    => in_array($row['field_type'], array('textarea', 'text')) ? 'input-text' : ''
            );
            if ($row['field_type'] == 'textarea') {
                $config['rows'] = 6;
                $config['cols'] = 60;
            }
            $this->addElement($row['field_type'], $field, $config);

            $el = $this->getElement($field);
            if ($row['required']) {
                $el->addValidator('NotEmpty')
                    ->setAttrib('class', $el->getAttrib('class') . ' required');
            }
            if (!empty($row['validator'])) {
                if ($row['validator'] == 'Date') {
                    $el->addValidator($row['validator'], false, array('format' => 'yyyy-MM-dd'));
                    $el->setAttrib('class', $el->getAttrib('class') . ' input-date');
                } else {
                    $el->addValidator($row['validator']);
                }
            }
            if (!empty($row['axis_validator'])) {
                $el->addValidator(new $row['axis_validator']());
            }
            if (isset($row['customer_valueset_id'])) {
                $values = Axis::single('account/Customer_ValueSet_Value')
                    ->getCustomValues(
                        $row['customer_valueset_id'],
                        Axis_Locale::getLanguageId()
                    );
                if (method_exists($el, 'setMultiOptions')) {
                    $el->setMultiOptions($values);
                }
            }
            $groupsFields[$row['customer_field_group_id']][$row['id']] = $field;
        }

        /* add field groups */
        if (count($groupsFields)) {
            $groups = Axis::single('account/customer_fieldGroup')
                ->getCustomGroups(
                    array_keys($groupsFields), Axis_Locale::getLanguageId()
                );

            foreach ($groups as $row) {
                $groupName = empty($row['name']) ?
                        $row['id'] : $row['name'];
                $this->addDisplayGroup(
                    array_values($groupsFields[$row['id']]),
                    $groupName,
                    array('legend' => $row['group_label'])
                );
                $this->getDisplayGroup($groupName)
                    ->setDisableTranslator(true);
            }
        }

        $this->addElement('button', 'submit', array(
            'type'  => 'submit',
            'class' => 'button',
            'label' => 'Register'
        ));

        $this->addActionBar(array('submit'));
    }
}