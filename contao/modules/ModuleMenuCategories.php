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

        if (!$this->categories_picker) {
            return false;
        }

        $selectedCategories = StringUtil::deserialize($this->categories_picker);
        $compiledMenu = [];

        foreach ($selectedCategories as $categoryId) {
            $category = MealsCategoryModel::findById($categoryId);
            $meals = $this->getTranslatedMeals($category->id, $currentLng);

            if ($meals) {
                $categoryTitle = $this->getTranslatedCategories($category->id, $currentLng) ?? $category->title;
                $compiledMenu[$categoryTitle] = $meals;
            }
        }

        $this->Template->menu = $compiledMenu;
    }

    /**
     * Get translated category title
     *
     * @param int    $id  The category ID
     * @param string $lng The target language
     *
     * @return string|null The translated category title or null if not found
     */
    protected function getTranslatedCategories(int $id, string $lng): ?string
    {
        $categories = MealsCategoryLanguageModel::findBy('pid', $id);

        if ($categories) {
            foreach ($categories as $category) {
                if ($category->language === $lng) {
                    return $category->title;
                }
            }
        }

        return null;
    }

    /**
     * Get translated meals for a category
     *
     * @param int    $categoryId The category ID
     * @param string $language   The target language
     *
     * @return array The translated meals
     */
    protected function getTranslatedMeals(int $categoryId, string $language): array
    {
        $meals = MealsModel::findBy("pid", $categoryId);

        if (!$meals) {
            return [];
        }

        $translatedMeals = [];

        foreach ($meals as $meal) {
            $mealTranslations = MealsLanguageModel::findBy("pid", $meal->id);
            $isMealAdded = false;

            if ($mealTranslations) {
                foreach ($mealTranslations as $translation) {
                    if ($translation->language === $language) {
                        $mealInfo = [
                            'title' => $translation->title ?: $meal->title,
                            'ingredients' => $translation->ingredients ?: $meal->ingredients,
                            'price' => $translation->price ?: $meal->price,
                        ];

                        // Remove ingredients if noingredients flag is set
                        if ($this->noingredients) {
                            $mealInfo['ingredients'] = '';
                        }

                        // Remove prices if noprices flag is set
                        if ($this->noprices) {
                            $mealInfo['price'] = '';
                        }

                        $translatedMeals[] = $mealInfo;
                        $isMealAdded = true;
                        break; // Stop further checking once the correct language is found
                    }
                }
            }

            // Add default meal information if no translation is found
            if (!$isMealAdded) {
                $mealInfo = [
                    'title' => $meal->title,
                    'ingredients' => $meal->ingredients,
                    'price' => $meal->price,
                ];

                // Remove ingredients if noingredients flag is set
                if ($this->noingredients) {
                    $mealInfo['ingredients'] = '';
                }

                // Remove prices if noprices flag is set
                if ($this->noprices) {
                    $mealInfo['price'] = '';
                }

                $translatedMeals[] = $mealInfo;
            }
        }

        return $translatedMeals;
    }
}
