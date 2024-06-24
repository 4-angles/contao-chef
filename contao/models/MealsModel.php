<?php

/*
 * This file is part of Contao Chef Bundle.
 *
 * (c) Miroslav Horvatov - Four Angles
 * Website: four-angles.com
 *
 * @license LGPL-3.0-or-later
 */

namespace FourAngles\ChefBundle\Models;

use Contao\Model\Collection;
use Contao\Model;
use FourAngles\ChefBundle\Models\MealsLanguageModel;

/**
 * Reads and writes meals
 *
 * @property integer $id
 * @property integer $tstamp
 * @property string  $title
 * @property string  $headline
 * @property integer $jumpTo
 * @property boolean $allowComments
 * @property string  $notify
 * @property string  $sortOrder
 * @property integer $perPage
 * @property boolean $moderate
 * @property boolean $bbcode
 * @property boolean $requireLogin
 * @property boolean $disableCaptcha
 *
 * @method static MealsModel|null findById($id, array $opt=array())
 * @method static MealsModel|null findByPk($id, array $opt=array())
 * @method static MealsModel|null findByIdOrAlias($val, array $opt=array())
 * @method static MealsModel|null findOneBy($col, $val, array $opt=array())
 * @method static MealsModel|null findOneByTstamp($val, array $opt=array())
 * @method static MealsModel|null findOneByTitle($val, array $opt=array())
 * @method static MealsModel|null findOneByHeadline($val, array $opt=array())
 * @method static MealsModel|null findOneByJumpTo($val, array $opt=array())
 * @method static MealsModel|null findOneByAllowComments($val, array $opt=array())
 * @method static MealsModel|null findOneByNotify($val, array $opt=array())
 * @method static MealsModel|null findOneBySortOrder($val, array $opt=array())
 * @method static MealsModel|null findOneByPerPage($val, array $opt=array())
 * @method static MealsModel|null findOneByModerate($val, array $opt=array())
 * @method static MealsModel|null findOneByBbcode($val, array $opt=array())
 * @method static MealsModel|null findOneByRequireLogin($val, array $opt=array())
 * @method static MealsModel|null findOneByDisableCaptcha($val, array $opt=array())
 *
 * @method static Collection<MealsModel>|MealsModel[]|null findByTstamp($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByTitle($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByHeadline($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByJumpTo($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByAllowComments($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByNotify($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findBySortOrder($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByPerPage($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByModerate($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByBbcode($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByRequireLogin($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findByDisableCaptcha($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findMultipleByIds($val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findBy($col, $val, array $opt=array())
 * @method static Collection<MealsModel>|MealsModel[]|null findAll(array $opt=array())
 *
 * @method static integer countById($id, array $opt=array())
 * @method static integer countByTstamp($val, array $opt=array())
 * @method static integer countByTitle($val, array $opt=array())
 * @method static integer countByHeadline($val, array $opt=array())
 * @method static integer countByJumpTo($val, array $opt=array())
 * @method static integer countByAllowComments($val, array $opt=array())
 * @method static integer countByNotify($val, array $opt=array())
 * @method static integer countBySortOrder($val, array $opt=array())
 * @method static integer countByPerPage($val, array $opt=array())
 * @method static integer countByModerate($val, array $opt=array())
 * @method static integer countByBbcode($val, array $opt=array())
 * @method static integer countByRequireLogin($val, array $opt=array())
 * @method static integer countByDisableCaptcha($val, array $opt=array())
 */
class MealsModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_cc_meals';


	/**
	 * Get language-specific meal information
	 *
	 * @param array  $meals       The list of meals to be translated
	 * @param string $language    The target language
	 * @param int    $noIngredients Flag to determine whether to remove ingredients (1 to remove, 0 to keep)
	 * @param int    $noPrices      Flag to determine whether to remove prices (1 to remove, 0 to keep)
	 *
	 * @return array The translated meals
	 */
	public static function getTranslatedMeals(array $meals, string $language, int $noIngredients = 0, int $noPrices = 0): array
	{
		$translatedMeals = [];

		foreach ($meals as $mealTitle) {
			$meal = MealsModel::findBy('title', $mealTitle);

			if (!$meal) {
				continue;
			}

			$mealTranslations = MealsLanguageModel::findBy('pid', $meal->id);

			if ($mealTranslations) {
				foreach ($mealTranslations as $translation) {
					if ($translation->language === $language) {
						$mealInfo = [
							'title' => $translation->title ?: $meal->title,
							'ingredients' => $translation->ingredients ?: $meal->ingredients,
							'price' => $translation->price ?: $meal->price,
						];

						// Remove ingredients if noIngredients flag is set
						if ($noIngredients) {
							$mealInfo['ingredients'] = '';
						}

						// Remove prices if noPrices flag is set
						if ($noPrices) {
							$mealInfo['price'] = '';
						}

						$translatedMeals[] = $mealInfo;
					}
				}
			} else {
				$mealInfo = [
					'title' => $meal->title,
					'ingredients' => $meal->ingredients,
					'price' => $meal->price,
				];

				// Remove ingredients if noIngredients flag is set
				if ($noIngredients) {
					$mealInfo['ingredients'] = '';
				}

				// Remove prices if noPrices flag is set
				if ($noPrices) {
					$mealInfo['price'] = '';
				}

				$translatedMeals[] = $mealInfo;
			}
		}

		return $translatedMeals;
	}

}
