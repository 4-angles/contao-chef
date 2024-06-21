<?php

/*
 * This file is part of Contao Chef Bundle.
 *
 * (c) Miroslav Horvatov - Four Angles
 *
 * @license LGPL-3.0-or-later
 */



use FourAngles\ChefBundle\Models\MealsCategoryModel;
use FourAngles\ChefBundle\Models\MealsCategoryLanguageModel;
use FourAngles\ChefBundle\Models\MealsLanguageModel;
use FourAngles\ChefBundle\Models\MealsModel;
use FourAngles\ChefBundle\Modules\ModuleMenuCategories;
use FourAngles\ChefBundle\Modules\ModuleMenuMeals;

// Add back end modules
$GLOBALS['BE_MOD']['contao_chef']['category'] = array
(
	'tables' => array('tl_cc_meals_category','tl_cc_meals_category_lng')
);
$GLOBALS['BE_MOD']['contao_chef']['meals'] = array
(
	'tables' => array('tl_cc_meals','tl_cc_meals_lng')
);



// Front end modules
$GLOBALS['FE_MOD']['cc_menu'] = array
(
	'cc_menu_categories'   => ModuleMenuCategories::class,
	'cc_menu_meals' => ModuleMenuMeals::class,
);



// Models
$GLOBALS['TL_MODELS']['tl_cc_meals_category'] = MealsCategoryModel::class;
$GLOBALS['TL_MODELS']['tl_cc_meals_category_lng'] = MealsCategoryLanguageModel::class;

$GLOBALS['TL_MODELS']['tl_cc_meals'] = MealsModel::class;
$GLOBALS['TL_MODELS']['tl_cc_meals_lng'] = MealsLanguageModel::class;