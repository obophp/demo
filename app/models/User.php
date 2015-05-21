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
class UserProperties extends \Base\EntityProperties{
    public $name = "default name";
    public $surname = "default surname";

    /**
     * @obo-one(targetEntity = "\Users\Address", autoCreate = true, cascade = "save, delete")
     */
    public $address = null;
    /**
     * @obo-one(targetEntity = "\Users\Sex")
     */
    public $sex = 1;
    /** @obo-many(targetEntity = "\Tag\Tag", connectViaRepository="RelationshipBetweenUserAndTag", sortVia = "{name}")*/
    public $tags = null;
    /**
     * @obo-columnName(mail)
     */
    public $email = "";
    public $phone = "";
    /** @obo-many(targetEntity = "\Notice\Notice", connectViaProperty = "user", cascade = "save, delete")*/
    public $notices = null;
    /**
     * @obo-dataType(integer)
     */
    public $countView = 0;
    /**
     * @obo-dataType(boolean)
     */
    public $hide = false;

    /** @obo-timeStamp(beforeInsert) */
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
 * @obo-repositoryName(UsersUsers)
 * @property string $name
 * @property string $surname
 * @property string $nameSurname
 * @property \Users\Sex $sex
 * @property string $email
 * @property string $phone
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
        $form->addRadioList("sex", "Sex", \Users\Sex::sexDial());
        $form->addGroup("Address");
        \Users\Address::constructForm($form, "address");
        $form->addGroup("Contact");
        $form->addText('email', "E-Mail",50);
        $form->addText('phone','Phone');
        $form->addCheckbox('hide', 'Hide');
        $form->addGroup("");
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

    /**
     * @obo-run(beforeWriteCountView)
     */
    public function test($arguments){
        $arguments["propertyValue"]["new"]++;
    }

}

# definition entity manager

class UserManager extends \Base\EntityManager{

    /**
     * @param int|array|null $specification
     * @return \Users\User
     */
    public static function user($specification) {
        return self::entity($specification);
    }

    /**
     * @param \obo\Interfaces\IPaginator $paginator
     * @param \obo\Interfaces\IFilter $filter
     * @return \obo\Entity
     */
    public static function users(\obo\Interfaces\IPaginator $paginator = null, \obo\Interfaces\IFilter $filter = null) {
        return self::findEntities(\obo\Carriers\QueryCarrier::instance(), $paginator, $filter);
    }

    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\For|\Users\User
     */
    public static function newUserFromForm(\Nette\Forms\Form $form) {
        return self::newEntityFromForm(\Users\User::constructForm($form));
    }

    /**
     * @param \Nette\Forms\Form $form
     * @param \Users\User $user
     * @return \Nette\Forms\For|\Users\User
     */
    public static function editUserFromForm(\Nette\Forms\Form $form, \Users\User $user = null) {
        return self::editEntityFromForm(\Users\User::constructForm($form), $user);
    }

}