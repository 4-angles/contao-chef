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
use Contao\PageModel;

$GLOBALS['TL_DCA']['tl_cc_meals_category_lng'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => DC_Table::class,
		'markAsCopy'                  => 'title',
		'ptable'                      => 'tl_cc_meals_category',
		'onload_callback' => array
		(
			array('tl_cc_meals_category_lng', 'adjustDca')
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
			'fields'                  => array('id','language','title'),
			'showColumns'			  => true,
			'label_callback'          => array('tl_cc_meals_category_lng', 'returnLabel')
		),
        'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals_category_lng']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals_category_lng']['delete'],
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
	),
),
	// Palettes
	'palettes' => array
	(
		'default'                     => '{language_legend},language;{title_legend},title;'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_cc_meals.title',
			'sql'                     => "int(10) unsigned NOT NULL default 0",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'title' => array
		(
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'language' => array
		(
			'filter'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_cc_meals_category_lng', 'getLanguages'),
			'eval'                    => array('mandatory'=>true,'submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => array('name'=>'language', 'type'=>'string', 'length'=>64, 'default'=>'', 'customSchemaOptions'=>array('collation'=>'ascii_bin'))
		),
	)
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_cc_meals_category_lng extends Backend
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

		$GLOBALS['TL_DCA']['tl_cc_meals_category_lng']['list']['sorting']['root'] = $root;
	}

		/**
	 * Return all languages as array
	 *
	 * @return array
	 */
	public function getLanguages(DataContainer $dc)
	{


		    // Get all roots
			$rootPages = PageModel::findByType("root");
			$rootPagesLanguages = [] ;
		
			foreach($rootPages as $root){
				$rootPagesLanguages[] = $root->language;
			}


			return $rootPagesLanguages;


	}

	/**
	 * Return label
	 *
	 *  @return string
	 */
	public function returnLabel($row, $label, $dc, array $labels)
	{

		$language = locale_get_display_language($row['language'],$GLOBALS['TL_LANGUAGE']);
		$labels[1] = $language;
	
		return $labels ;

	}
}