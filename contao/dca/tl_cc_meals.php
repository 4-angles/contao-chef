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

$GLOBALS['TL_DCA']['tl_cc_meals'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => DC_Table::class,
		'switchToEdit'                => true,
		'ctable'                      => array('tl_cc_meals_lng'),
		'enableVersioning'            => true,
		'markAsCopy'                  => 'title',
		'onload_callback' => array
		(
			array('tl_cc_meals', 'adjustDca')
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
			'fields'                  => array('title'),
			'panelLayout'             => 'filter;sort,search,limit',
		),
		'label' => array
		(
			'fields'                  => array('id','title','category','ingredients','price'),
			'showColumns'			  => true,
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
            'meals_lng' => array
			(
				'icon'                => 'bundles/contaochef/icons/languages.svg',
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals']['meals_lng'],
				'href'                => 'table=tl_cc_meals_lng',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title;{category_legend},category;{info_legend},ingredients,price;'
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
		'category' => array
		(
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_cc_meals', 'getMealCategories'),
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => array('name'=>'category', 'type'=>'string', 'length'=>64, 'default'=>'', 'customSchemaOptions'=>array('collation'=>'ascii_bin'))
		),
		'ingredients' => array
		(
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
			'sql'                     => "text NULL"
		),
		'price' => array
		(
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
	)
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_cc_meals extends Backend
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

		$GLOBALS['TL_DCA']['tl_cc_meals']['list']['sorting']['root'] = $root;
	}

		/**
	 * Return all content elements as array
	 *
	 * @return array
	 */
	public function getMealCategories(DataContainer $dc)
	{

			$groups = Database::getInstance()
				->prepare("SELECT * FROM tl_cc_meals_category")
				->execute()->fetchAllAssoc();

			$categories = [];	
			foreach($groups as $v){
				$categories[] = $v['title'];
			}


		return $categories;
	}
}