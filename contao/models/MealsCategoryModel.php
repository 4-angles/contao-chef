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

/**
 * Reads and writes categories
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
 * @method static MealsCategoryModel|null findById($id, array $opt=array())
 * @method static MealsCategoryModel|null findByPk($id, array $opt=array())
 * @method static MealsCategoryModel|null findByIdOrAlias($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneBy($col, $val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByTstamp($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByTitle($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByHeadline($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByJumpTo($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByAllowComments($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByNotify($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneBySortOrder($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByPerPage($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByModerate($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByBbcode($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByRequireLogin($val, array $opt=array())
 * @method static MealsCategoryModel|null findOneByDisableCaptcha($val, array $opt=array())
 *
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByTstamp($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByTitle($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByHeadline($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByJumpTo($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByAllowComments($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByNotify($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findBySortOrder($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByPerPage($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByModerate($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByBbcode($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByRequireLogin($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findByDisableCaptcha($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findMultipleByIds($val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findBy($col, $val, array $opt=array())
 * @method static Collection<MealsCategoryModel>|MealsCategoryModel[]|null findAll(array $opt=array())
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
class MealsCategoryModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_cc_meals_category';
}
