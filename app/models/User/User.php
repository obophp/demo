<?php

/**
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011 - 2013 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Models;

# A class defining the entity is usually better to split into its own file. Here are clarity placed in one file

# definition of properties
class UserProperties extends \Base\EntityProperties{

    public $name = "default name";
    public $surname = "default surname";

    /**
     * @obo-one(targetEntity = "\Models\User\Contact", autoCreate = true, eager = true, cascade = "save, delete")
     */
    public $contact = null;

    /**
     * @obo-one(targetEntity = "\Models\User\Sex", eager = true)
     */
    public $sex = 1;

    /**
     * @obo-many(targetEntity = "\Models\Tag", connectViaRepository="relationship_between_user_and_tag", sortVia = "{name}")
     */
    public $tags = null;

    /**
     * @obo-many(targetEntity = "\Models\Notice", connectViaProperty = "owner", ownerNameInProperty = "ownerEntityName", cascade = "save, delete")
     */
    public $notices = null;

    /**
     * @obo-dataType(integer)
     */
    public $countView = 0;

    /**
     * @obo-dataType(boolean)
     */
    public $hide = false;

    /**
     * @obo-timeStamp(beforeInsert)
     */
    public $dateTimeInserted = null;

    /**
     * @obo-timeStamp(beforeUpdate)
     */
    public $dateTimeUpdated = null;

    /**
     * Implementation of the dynamic properties
     * @return string
     */
    public function getNameSurname() {
        return "{$this->_owner->name} {$this->_owner->surname}";
    }

    /**
     * If it is defined getter or setter of the property so is used, else is called variable directly
     * @return string
     */
    public function getName() {
        # Here we can do anything
        return $this->name;
    }
}

# definition entity

/**
 * @obo-repositoryName(user)
 * @property string $name
 * @property string $surname
 * @property string $nameSurname
 * @property \Models\User\Contact $contact
 * @property \Users\Sex $sex
 * @property \Notice\Notice[] $notices
 * @property \Tag\Tag[] $tags
 * @property int $countView
 * @property boolean $hide
 * @property string $dateTimeInserted
 * @property string $dateTimeUpdated
 */
class User extends \Base\Entity{

    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\Form
     */
    public static function constructForm(\Nette\Forms\Form $form) {
        $form->addHidden('id');
        $form->addGroup("Base information");
        $form->addText('name', 'Name',20);
        $form->addText('surname', 'Surname',20);
        $form->addRadioList("sex", "Sex", \Models\User\Sex::sexDial());
        $form->addGroup("Contact");
        \Models\User\Contact::constructForm($form, "contact");
        $form->addGroup("");
        $form->addCheckbox('hide', 'Hide');
        return $form;
    }

    /**
     * @obo-run("onViewInDetail")
     */
    public function increaseCountView() {
        # This method is automatically called when the event 'onViewInDetail' occurs over an entity
        $this->countView++;
        $this->save();
    }

}

# definition entity manager

class UserManager extends \Base\EntityManager{

    /**
     * @param int|array $specification
     * @return\Models\User
     */
    public static function user($specification) {
        return static::entity($specification);
    }

    /**
     * @param \obo\Interfaces\IPaginator $paginator
     * @param \obo\Interfaces\IFilter $filter
     * @return \Models\User[]
     */
    public static function users(\obo\Interfaces\IPaginator $paginator = null, \obo\Interfaces\IFilter $filter = null) {
        return static::findEntities(static::querySpecification(), $paginator, $filter);
    }

    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\For|\Models\User
     */
    public static function newUserFromForm(\Nette\Forms\Form $form) {
        return static::newEntityFromForm(\Models\User::constructForm($form));
    }

    /**
     * @param \Nette\Forms\Form $form
     * @param \Models\User $user
     * @return \Nette\Forms\For|\Users\User
     */
    public static function editUserFromForm(\Nette\Forms\Form $form, \Models\User $user = null) {
        return static::editEntityFromForm(\Models\User::constructForm($form), $user);
    }

}
