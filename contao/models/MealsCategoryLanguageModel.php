<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
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
 * @method static MealsCategoryLanguageModel|null findById($id, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findByPk($id, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findByIdOrAlias($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneBy($col, $val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByTstamp($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByTitle($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByHeadline($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByJumpTo($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByAllowComments($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByNotify($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneBySortOrder($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByPerPage($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByModerate($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByBbcode($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByRequireLogin($val, array $opt=array())
 * @method static MealsCategoryLanguageModel|null findOneByDisableCaptcha($val, array $opt=array())
 *
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByTstamp($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByTitle($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByHeadline($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByJumpTo($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByAllowComments($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByNotify($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findBySortOrder($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByPerPage($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByModerate($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByBbcode($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByRequireLogin($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findByDisableCaptcha($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findMultipleByIds($val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findBy($col, $val, array $opt=array())
 * @method static Collection<MealsCategoryLanguageModel>|MealsCategoryLanguageModel[]|null findAll(array $opt=array())
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
class MealsCategoryLanguageModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_cc_meals_category_lng';

}