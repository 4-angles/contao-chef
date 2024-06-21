<?php

/*
 * This file is part of Contao Chef Bundle.
 *
 * (c) Miroslav Horvatov - Four Angles
 *
 * @license LGPL-3.0-or-later
 */



use FourAngles\ChefBundle\MealsCategoryModel;


// Add back end modules
$GLOBALS['BE_MOD']['contao_chef']['category'] = array
(
	'tables' => array('tl_cc_meals_category','tl_cc_meals_category_lng')
);
$GLOBALS['BE_MOD']['contao_chef']['meals'] = array
(
	'tables' => array('tl_cc_meals','tl_cc_meals_lng')
);




// Models
$GLOBALS['TL_MODELS']['tl_meals_category'] = MealsCategoryModel::class;