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
 * @method static MealsLanguageModel|null findById($id, array $opt=array())
 * @method static MealsLanguageModel|null findByPk($id, array $opt=array())
 * @method static MealsLanguageModel|null findByIdOrAlias($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneBy($col, $val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByTstamp($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByTitle($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByHeadline($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByJumpTo($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByAllowComments($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByNotify($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneBySortOrder($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByPerPage($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByModerate($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByBbcode($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByRequireLogin($val, array $opt=array())
 * @method static MealsLanguageModel|null findOneByDisableCaptcha($val, array $opt=array())
 *
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByTstamp($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByTitle($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByHeadline($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByJumpTo($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByAllowComments($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByNotify($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findBySortOrder($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByPerPage($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByModerate($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByBbcode($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByRequireLogin($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findByDisableCaptcha($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findMultipleByIds($val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findBy($col, $val, array $opt=array())
 * @method static Collection<MealsLanguageModel>|MealsLanguageModel[]|null findAll(array $opt=array())
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
class MealsLanguageModel extends Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_cc_meals_lng';

}