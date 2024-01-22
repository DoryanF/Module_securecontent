<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class SecureContent extends Module
{
    public function __construct()
    {
        $this->name = 'securecontent';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Doryan Fourrichon';
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => _PS_VERSION_
        ];
        
        //récupération du fonctionnement du constructeur de la méthode __construct de Module
        parent::__construct();
        $this->bootstrap = true;

        $this->displayName = $this->l('Secure Content');
        $this->description = $this->l('This module makes it possible to deactivate keyboard shortcuts to protect your contents');

        $this->confirmUninstall = $this->l('Do you want to delete this module');
    }

    public function install()
    {
        if (!parent::install() ||
        !Configuration::updateValue('RIGHTDEACTIVATE',0) ||
        !Configuration::updateValue('DEVICENULL', 0) ||
        !Configuration::updateValue('COPYNULL', 0) ||
        !Configuration::updateValue('SELECTNULL', 0) ||
        !Configuration::updateValue('DEACTIVATE_ALTE', 0) ||
        !Configuration::updateValue('DEACTIVATE_ALTF', 0) ||
        !Configuration::updateValue('DEACTIVATESEARCH', 0) ||
        !Configuration::updateValue('DEACTIVATE_SHIFTI', 0) ||
        !Configuration::updateValue('DEACTIVATE_SHIFTJ', 0) ||
        !Configuration::updateValue('DEACTIVATE_SHIFTQ', 0) ||
        !Configuration::updateValue('DEACTIVATE_CTRLP', 0) ||
        !Configuration::updateValue('DEACTIVATE_CTRLQ', 0) ||
        !$this->registerHook('displayHeader')
        ) {
            return false;
        }
            return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() ||
        !Configuration::deleteByName('RIGHTDEACTIVATE') ||
        !Configuration::deleteByName('DEVICENULL') ||
        !Configuration::deleteByName('COPYNULL') ||
        !Configuration::deleteByName('SELECTNULL') ||
        !Configuration::deleteByName('DEACTIVATE_ALTE') ||
        !Configuration::deleteByName('DEACTIVATE_ALTF') ||
        !Configuration::deleteByName('DEACTIVATESEARCH') ||
        !Configuration::deleteByName('DEACTIVATE_SHIFTI') ||
        !Configuration::deleteByName('DEACTIVATE_SHIFTJ') ||
        !Configuration::deleteByName('DEACTIVATE_SHIFTQ') ||
        !Configuration::deleteByName('DEACTIVATE_CTRLP') ||
        !Configuration::deleteByName('DEACTIVATE_CTRLQ') ||
        !$this->unregisterHook('displayHeader')
        ) {
            return false;
        }
            return true;
    }

    public function getContent()
    {
        return $this->postProcess().$this->renderForm();
    }

    public function renderForm()
    {
        $field_form[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings'),
            ],
            'input' => [
                [
                    'type' => 'switch',
                        'label' => $this->l('Block right clic ?'),
                        'name' => 'RIGHTDEACTIVATE',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable touch mobile device ?'),
                        'name' => 'DEVICENULL',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable copy ?'),
                        'name' => 'COPYNULL',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable select ?'),
                        'name' => 'SELECTNULL',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable ALT + E ?'),
                        'name' => 'DEACTIVATE_ALTE',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable ALT + F ?'),
                        'name' => 'DEACTIVATE_ALTF',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable shortcut search ?'),
                        'name' => 'DEACTIVATESEARCH',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable SHIFT + I ?'),
                        'name' => 'DEACTIVATE_SHIFTI',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable SHIFT + J ?'),
                        'name' => 'DEACTIVATE_SHIFTJ',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable SHIFT + Q ?'),
                        'name' => 'DEACTIVATE_SHIFTQ',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable print ?'),
                        'name' => 'DEACTIVATE_CTRLP',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                [
                    'type' => 'switch',
                        'label' => $this->l('Disable CTRL + Q ?'),
                        'name' => 'DEACTIVATE_CTRLQ',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'label2_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'label2_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        )
                ],
                
            ],
            'submit' => [
                'title' => $this->l('save'),
                'class' => 'btn btn-primary',
                'name' => 'saving'
            ]
        ];

        $helper = new HelperForm();
        $helper->module  = $this;
        $helper->name_controller = $this->name;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->fields_value['RIGHTDEACTIVATE'] = Configuration::get('RIGHTDEACTIVATE');
        $helper->fields_value['DEVICENULL'] = Configuration::get('DEVICENULL');
        $helper->fields_value['COPYNULL'] = Configuration::get('COPYNULL');
        $helper->fields_value['SELECTNULL'] = Configuration::get('SELECTNULL');
        $helper->fields_value['DEACTIVATE_ALTE'] = Configuration::get('DEACTIVATE_ALTE');
        $helper->fields_value['DEACTIVATE_ALTF'] = Configuration::get('DEACTIVATE_ALTF');
        $helper->fields_value['DEACTIVATESEARCH'] = Configuration::get('DEACTIVATESEARCH');
        $helper->fields_value['DEACTIVATE_SHIFTI'] = Configuration::get('DEACTIVATE_SHIFTI');
        $helper->fields_value['DEACTIVATE_SHIFTJ'] = Configuration::get('DEACTIVATE_SHIFTJ');
        $helper->fields_value['DEACTIVATE_SHIFTQ'] = Configuration::get('DEACTIVATE_SHIFTQ');
        $helper->fields_value['DEACTIVATE_CTRLP'] = Configuration::get('DEACTIVATE_CTRLP');
        $helper->fields_value['DEACTIVATE_CTRLQ'] = Configuration::get('DEACTIVATE_CTRLQ');

        return $helper->generateForm($field_form);
    }

    public function postProcess()
    {
        if(Tools::isSubmit('saving'))
        {
            if (Validate::isBool(Tools::getValue('RIGHTDEACTIVATE')) && Validate::isBool(Tools::getValue('DEVICENULL'))
            && Validate::isBool(Tools::getValue('COPYNULL')) && Validate::isBool(Tools::getValue('SELECTNULL'))
            && Validate::isBool(Tools::getValue('DEACTIVATE_ALTE')) && Validate::isBool(Tools::getValue('DEACTIVATE_ALTF'))
            && Validate::isBool(Tools::getValue('DEACTIVATESEARCH')) && Validate::isBool(Tools::getValue('DEACTIVATE_SHIFTI'))
            && Validate::isBool(Tools::getValue('DEACTIVATE_SHIFTJ')) && Validate::isBool(Tools::getValue('DEACTIVATE_SHIFTQ'))
            && Validate::isBool(Tools::getValue('DEACTIVATE_CTRLP')) && Validate::isBool(Tools::getValue('DEACTIVATE_CTRLQ'))
            ) {
                //alt
                Configuration::updateValue('DEACTIVATE_ALTE',Tools::getValue('DEACTIVATE_ALTE'));
                Configuration::updateValue('DEACTIVATE_ALTF',Tools::getValue('DEACTIVATE_ALTF'));
                //shift
                Configuration::updateValue('DEACTIVATE_SHIFTI',Tools::getValue('DEACTIVATE_SHIFTI'));
                Configuration::updateValue('DEACTIVATE_SHIFTJ',Tools::getValue('DEACTIVATE_SHIFTJ'));
                Configuration::updateValue('DEACTIVATE_SHIFTQ',Tools::getValue('DEACTIVATE_SHIFTQ'));
                //ctrl
                Configuration::updateValue('DEACTIVATE_CTRLP',Tools::getValue('DEACTIVATE_CTRLP'));
                Configuration::updateValue('DEACTIVATE_CTRLQ',Tools::getValue('DEACTIVATE_CTRLQ'));
                //others
                Configuration::updateValue('RIGHTDEACTIVATE',Tools::getValue('RIGHTDEACTIVATE'));
                Configuration::updateValue('DEVICENULL',Tools::getValue('DEVICENULL'));
                Configuration::updateValue('COPYNULL',Tools::getValue('COPYNULL'));
                Configuration::updateValue('SELECTNULL',Tools::getValue('SELECTNULL'));
                Configuration::updateValue('DEACTIVATESEARCH',Tools::getValue('DEACTIVATESEARCH'));

                return $this->displayConfirmation('Well recorded!');
            }
        }
    }

    public function hookDisplayHeader()
    {
        $this->smarty->assign(array(
            //switch alt
            'switch_alt_e' => Configuration::get('DEACTIVATE_ALTE'),
            'switch_alt_f' => Configuration::get('DEACTIVATE_ALTF'),
            //switch shift
            'switch_shift_i' => Configuration::get('DEACTIVATE_SHIFTI'),
            'switch_shift_j' => Configuration::get('DEACTIVATE_SHIFTJ'),
            'switch_shift_q' => Configuration::get('DEACTIVATE_SHIFTQ'),
            //switch ctrl
            'switch_ctrl_p' => Configuration::get('DEACTIVATE_CTRLP'),
            'switch_ctrl_q' => Configuration::get('DEACTIVATE_CTRLQ'),
            //other switch
            'switch_click_right' => Configuration::get('RIGHTDEACTIVATE'),
            'switch_block_click_device' => Configuration::get('DEVICENULL'),
            'switch_block_copy' => Configuration::get('COPYNULL'),
            'switch_block_select' => Configuration::get('SELECTNULL'),
            'switch_block_search' => Configuration::get('DEACTIVATESEARCH')
        ));

        return $this->display(__FILE__, '/views/templates/hooks/displayHeader.tpl');
    }
}