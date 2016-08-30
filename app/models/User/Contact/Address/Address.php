<?php

/**
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011 - 2013 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Models\User\Contact;

# A class defining the entity is usually better to split into its own file. Here are clarity placed in one file
# definition of properties

class AddressProperties extends \Base\EntityProperties {

    /**
     * @obo-one(targetEntity = "\Models\User\Contact", connectViaProperty="address")
     */
    public $contact = null;
    public $street = "";
    public $city = "";
    public $zip = "";

}

# definition entity

/**
 * @obo-repositoryName(user_contact_address)
 * @property \Models\User\Contact $contact
 * @property string $street
 * @property string $city
 * @property string $zip
 */
class Address extends \Base\Entity {

    /**
     * @param \Base\Form $form
     * @param string $controlPrefix
     */
    public static function constructForm(\Base\Form $form, $controlPrefix = null) {
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "street", "street");
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "city", "city");
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "zip", "zip");
    }

}

# definition entity manager

class AddressManager extends \Base\EntityManager {

}
