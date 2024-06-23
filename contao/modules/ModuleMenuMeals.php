<?php

/*
 * This file is part of Contao Chef Bundle.
 *
 * (c) Miroslav Horvatov - Four Angles
 * Website: four-angles.com
 *
 * @license LGPL-3.0-or-later
 */

namespace FourAngles\ChefBundle\Modules;

use Contao\Module;
use Contao\System;
use Contao\BackendTemplate;
use Contao\StringUtil;
use FourAngles\ChefBundle\Models\MealsCategoryLanguageModel;
use FourAngles\ChefBundle\Models\MealsCategoryModel;
use FourAngles\ChefBundle\Models\MealsLanguageModel;
use FourAngles\ChefBundle\Models\MealsModel;

/**
 * Class ModuleFaqList
 *
 * @property array $faq_categories
 * @property int   $faq_readerModule
 */
class ModuleMenuMeals extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_cc_menu_meals';

    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['FMD']['cc_menu_meals'][0] . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = StringUtil::specialcharsUrl(System::getContainer()->get('router')->generate('contao_backend', array('do' => 'themes', 'table' => 'tl_module', 'act' => 'edit', 'id' => $this->id)));

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {

        global $objPage;

        $currentLng = $objPage->rootLanguage;
        $selectedMeals = StringUtil::deserialize($this->meals_picker);

        $meals = $this->getTranslatedMeals($selectedMeals, $currentLng);


        $this->Template->menu = $meals;
    }



    /**
     * Get language specific info
     */
    protected function getTranslatedMeals($meals, $lng)
    {
        $langMeals = [];
        foreach ($meals as $m) {

            $meal = MealsModel::findBy('title', $m);
            $mealLng = MealsLanguageModel::findBy('pid', $meal->id);

            if ($mealLng) {
                foreach ($mealLng as $v) {
                    if ($v->language == $lng) {

                        // Fallback if price is not set in language
                        if (!$v->price) {
                            $v->price = $meal->price;
                        }

                        $langMeals[] = [
                            "title" => $v->title,
                            "ingredients" => $v->ingredients,
                            "price" => $v->price,
                        ];
                    }
                }
            } else {
                $langMeals[] = [
                    "title" => $meal->title,
                    "ingredients" => $meal->ingredients,
                    "price" => $meal->price,
                ];
            }
        }

        return $langMeals;
    }
}
