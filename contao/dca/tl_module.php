<?php



$GLOBALS['TL_DCA']['tl_module']['palettes']['cc_menu_categories']   = '{title_legend},name,headline,type;{categories_legend},categories_picker;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['cc_menu_meals']   = '{title_legend},name,headline,type;{categories_legend},meals_picker;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID';


// Add fields to tl_module
$GLOBALS['TL_DCA']['tl_module']['fields']['categories_picker'] = array
(
    'inputType' => 'picker',
    'eval' => [
        'multiple' => true,
        'isSortable' => true
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false,
    ],
    'relation' => [
        'type' => 'hasMany',
        'load' => 'lazy',
        'table' => 'tl_cc_meals_category',
    ],
);


// Add fields to tl_module
$GLOBALS['TL_DCA']['tl_module']['fields']['meals_picker'] = array
(
    'inputType' => 'picker',
    'eval' => [
        'multiple' => true,
        'isSortable' => true
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false,
    ],
    'relation' => [
        'type' => 'hasMany',
        'load' => 'lazy',
        'table' => 'tl_cc_meals',
    ],
);