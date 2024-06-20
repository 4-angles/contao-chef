<?php

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

use Contao\Backend;
use Contao\BackendUser;
use Contao\Database;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\StringUtil;
use Contao\System;

$GLOBALS['TL_DCA']['tl_cc_meals_lng'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => DC_Table::class,
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'markAsCopy'                  => 'title',
		'onload_callback' => array
		(
			array('tl_cc_meals_lng', 'adjustDca')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'tstamp' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 0,
		),
		'label' => array
		(
			'fields'                  => array('title','ingredients'),
			'format'                  => '%s <span class="label-info">[%s]</span>'
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title;{info_legend},ingredients,category;'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'title' => array
		(
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'ingredients' => array
		(
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
			'sql'                     => "text NULL"
		),
		'language' => array
		(
			'filter'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_cc_meals_lng', 'getMealCategories'),
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => array('name'=>'category', 'type'=>'string', 'length'=>64, 'default'=>'', 'customSchemaOptions'=>array('collation'=>'ascii_bin'))
		),
	)
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_cc_meals_lng extends Backend
{
	/**
	 * Set the root IDs.
	 */
	public function adjustDca()
	{
		$user = BackendUser::getInstance();

		if ($user->isAdmin)
		{
			return;
		}

		// Set root IDs
		if (empty($user->faqs) || !is_array($user->faqs))
		{
			$root = array(0);
		}
		else
		{
			$root = $user->faqs;
		}

		$GLOBALS['TL_DCA']['tl_cc_meals_lng']['list']['sorting']['root'] = $root;
	}

		/**
	 * Return all content elements as array
	 *
	 * @return array
	 */
	public function getMealCategories(DataContainer $dc)
	{

			$groups = Database::getInstance()
				->prepare("SELECT * FROM tl_cc_meals_lng_category")
				->execute()->fetchAllAssoc();

			$categories = [];	
			foreach($groups as $v){
				$categories[] = $v['title'];
			}


		return $categories;
	}
}