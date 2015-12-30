<?php

/**
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011 - 2013 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Models\User;

# A class defining the entity is usually better to split into its own file. Here are clarity placed in one file

# definition of properties
class ContactProperties extends \Base\EntityProperties {

    /**
     * @obo-one(targetEntity = "\Models\User", connectViaProperty="contact")
     */
    public $user = null;

    /**
     * @obo-one(targetEntity = "\Models\User\Contact\Address", autoCreate = true, eager = true, cascade = "save, delete")
     */
    public $address = null;
    public $email = "default@mail.com";
    public $phone = "777 777 777";

    /**
     * @obo-one(targetEntity = "\Models\Notice", connectViaProperty="owner", ownerNameInProperty = "ownerEntityName", eager = true, autoCreate = true, cascade = "save, delete")
     */
    public $notice = null;
}

# definition entity

/**
 * @obo-repositoryName(user_contact)
 * @property \Models\User $user
 * @property \Models\User\Contact\Address $address
 * @property string $email
 * @property string $phone
 */
class Contact extends \Base\Entity {

    /**
     * @param \Base\Form $form
     * @param string $controlPrefix
     */
    public static function constructForm(\Base\Form $form, $controlPrefix = null) {
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "email", "E-Mail", 50);
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "phone", "Phone");
        $form->addGroup("Address");
        \Models\User\Contact\Address::constructForm($form, ($controlPrefix ? $controlPrefix . "_" : "") . "address");
        $form->addGroup("Notice");
        $form->addText(($controlPrefix ? $controlPrefix . "_" : "") . "notice_text", "Notice");
    }
}

# definition entity manager

class ContactManager extends \Base\EntityManager {

}
