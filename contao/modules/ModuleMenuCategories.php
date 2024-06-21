<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
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
class ModuleMenuCategories extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_cc_menu_categories';

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
            $objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['FMD']['cc_menu_categories'][0] . ' ###';
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
        $selectedCategories = StringUtil::deserialize($this->categories_picker);

        $compiledMenu = [];

        foreach ($selectedCategories as $v) {
            $category = MealsCategoryModel::findById($v);

            $meals = $this->getTranslatedMeals($category->title, $currentLng);
            if ($meals) {
                if ($this->getTranslatedCategories($category->id, $currentLng)) {
                    $compiledMenu[$this->getTranslatedCategories($category->id, $currentLng)] =  $meals;
                } else {
                    $compiledMenu[$category->title] = $meals;
                }
            }
        }
        $this->Template->menu = $compiledMenu;


    }


    /**
     * Get language specific info
     */
    protected function getTranslatedCategories($id, $lng)
    {

        $categories = MealsCategoryLanguageModel::findBy('pid', $id);
        if ($categories) {
            $langCat = [];

            foreach ($categories as $v) {
                $langCat[$v->language]  = $v->title;
            }

            if(array_key_exists($lng,$langCat)){
                return $langCat[$lng];
            }
        }

        return [];
    }


    /**
     * Get language specific info
     */
    protected function getTranslatedMeals($ctitle, $lng)
    {
        $meals = MealsModel::findBy("category", $ctitle);

        if (!$meals) {
            return [];
        }
        $langMeals = [];
        foreach ($meals as $m) {

            $mealsLngObj = MealsLanguageModel::findBy("pid", $m->id);
            if ($mealsLngObj) {
                foreach ($mealsLngObj as $val) {
                    if ($val->language == $lng) {
                        // Language specific
                        $langMeals[] = [
                            "title" => $val->title,
                            "ingredients" => $val->ingredients,
                            "price" => $val->price,
                        ];
                    }
                }
            }
            else {
                $langMeals[] = [
                    "title" => $m->title,
                    "ingredients" => $m->ingredients,
                    "price" => $m->price,
                ];
            }
        }

        return $langMeals;
    }
}
