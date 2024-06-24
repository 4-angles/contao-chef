<?php

use FourAngles\ChefBundle\Models\MealsModel;
use Contao\Backend;
use FourAngles\ChefBundle\Models\MealsCategoryLanguageModel;
use FourAngles\ChefBundle\Models\MealsCategoryModel;
use FourAngles\ChefBundle\Models\MealsLanguageModel;

// Add paletes
$GLOBALS['TL_DCA']['tl_module']['palettes']['cc_menu_categories']   = '{title_legend},name,headline,type;{categories_legend},categories_picker;{info_legend},noprices,noingredients;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['cc_menu_meals']   = '{title_legend},name,headline,type;{categories_legend},meals_picker;{info_legend},noprices,noingredients;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID';


// Field for noprices checkbox
$GLOBALS['TL_DCA']['tl_module']['fields']['noprices'] = array(
    'inputType'               => 'checkbox',
    'sql'                     => array('type' => 'boolean', 'default' => false)
);
// Field for noingredients checkbox
$GLOBALS['TL_DCA']['tl_module']['fields']['noingredients'] = array(
    'inputType'               => 'checkbox',
    'sql'                     => array('type' => 'boolean', 'default' => false)
);


// Catergories picker
$GLOBALS['TL_DCA']['tl_module']['fields']['categories_picker'] = array(
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


// Meals picker
$GLOBALS['TL_DCA']['tl_module']['fields']['meals_picker'] = array(
    'inputType' => 'checkboxWizard',
    'options_callback'        => array('tl_module_cc', 'getMeals'),
    'eval' => [
        'multiple' => true,
        'mandatory' => true
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false,
    ],
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_module_cc extends Backend
{
    /**
     * Get all meals
     */
    public function getMeals()
    {

        $meals = MealsModel::findAll();
        $mealsTitles = [];

        foreach ($meals as $m) {

            $title = $m->title;

            $mealsTitles[] = $title;
        }


        return $mealsTitles;
    }
}
