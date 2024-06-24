<?php
namespace FourAngles\ChefBundle\Elements;

use Contao\ContentText;
use Contao\StringUtil;
use FourAngles\ChefBundle\Models\MealsModel;

use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class ContentCCMealCombo extends ContentText
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_cc_meal_combo';

    /**
     * Generate the content element
     */
    protected function compile()
    {

        if (
            System::getContainer()->get('contao.routing.scope_matcher')
                ->isFrontendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))
        ) {

            global $objPage;
            $currentLng = $objPage->rootLanguage;

            if (!$this->items_picker) {
                return false;
            }

            $selectedMeals = StringUtil::deserialize($this->items_picker);
            $meals = MealsModel::getTranslatedMeals($selectedMeals, $currentLng, $this->noingredients, $this->noprices);
            // $meals = $this->getTranslatedMeals($selectedMeals, $currentLng);

            $this->Template->menu = $meals;
        }


        parent::compile();
    }



}

