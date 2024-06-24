<?php

use FourAngles\ChefBundle\Models\MealsModel;
use Contao\Backend;
//
$GLOBALS['TL_DCA']['tl_content']['palettes']['mealcombo']   = '{title_legend},type,headline;{items_legend},items_picker;{info_legend},noprices,noingredients;{text_legend},text;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID';


// Items picker
$GLOBALS['TL_DCA']['tl_content']['fields']['items_picker'] = array(
    'inputType' => 'checkboxWizard',
    'options_callback'        => array('tl_content_cc', 'getMeals'),
    'eval' => [
        'multiple' => true,
        'mandatory' => true
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false,
    ],
);

// Field for noprices checkbox
$GLOBALS['TL_DCA']['tl_content']['fields']['noprices'] = array(
    'inputType'               => 'checkbox',
    'sql'                     => array('type' => 'boolean', 'default' => false)
);
// Field for noingredients checkbox
$GLOBALS['TL_DCA']['tl_content']['fields']['noingredients'] = array(
    'inputType'               => 'checkbox',
    'sql'                     => array('type' => 'boolean', 'default' => false)
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_content_cc extends Backend
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
