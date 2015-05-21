<?php

/**
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011 - 2013 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Users;

# A class defining the entity is usually better to split into its own file. Here are clarity placed in one file

# definition of properties
class AddressProperties extends \Base\EntityProperties {
    /**
     * @obo-one(targetEntity = "\Users\User", connectViaProperty="address")
     */
    public $user = null;
    public $street = "";
    public $city = "";
    public $zip = "";
}

# definition entity

/**
 * @property string $street
 * @property string $city
 * @property string $zip
 */
class Address extends \Base\Entity{

    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\Form
     */
    public static function constructForm(\Nette\Forms\Form $form, $controlPrefix = null) {
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "street", "street");
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "city", "city");
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "zip", "zip");
        return $form;
    }
}

# definition entity manager

class AddressManager extends \Base\EntityManager{

}