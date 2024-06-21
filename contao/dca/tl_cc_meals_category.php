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

$GLOBALS['TL_DCA']['tl_cc_meals_category'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => DC_Table::class,
		'markAsCopy'                  => 'title',
		'ctable'                      => array('tl_cc_meals_category_lng'),
		'onload_callback' => array
		(
			array('tl_cc_meals_category', 'adjustDca')
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
			'fields'                  => array('id','title'),
			'showColumns'			  => true,
        ),
        'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals_category']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
            'category_lng' => array
			(
				'icon'                => 'bundles/contaochef/icons/languages.svg',
				'label'               => &$GLOBALS['TL_LANG']['tl_cc_meals_category']['category_lng'],
				'href'                => 'table=tl_cc_meals_category_lng',
			),
			'delete'
	),
),
	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},title;'
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
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		)
	)
);

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_cc_meals_category extends Backend
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

		$GLOBALS['TL_DCA']['tl_cc_meals_category']['list']['sorting']['root'] = $root;
	}

}