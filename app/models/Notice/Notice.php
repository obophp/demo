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

class NoticeProperties extends \Base\EntityProperties {

    /** @obo-one(targetEntity = "property:ownerEntityName")*/
    public $owner = null;
    public $ownerEntityName = "";
    
    public $text = "default notice";

    /**
     * @obo-timeStamp(beforeInsert)
     */
    public $dateTimeInserted = "";
    public $deleted = false;
}

# definition entity

/**
 * @obo-repositoryName(notice)
 * @obo-softDeletable
 * @property \Models\User $user
 * @property string $text
 * @property string $dateTimeInserted
 */
class Notice extends \Base\Entity{

    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\Form
     */
    public static function constructForm(\Nette\Forms\Form $form) {
        $form->addHidden('id');
        $form->addText('text', 'Text notice', 50);

        return $form;
    }
}

# definition entity manager

class NoticeManager extends \Base\EntityManager{

    /**
     * @param int|array $specification
     * @return \Models\Notice
     */
    public static function notice($specification) {
        return static::entity($specification);
    }

    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\Form | \Models\Notice
     */
    public static function newNoticeFromForm(\Nette\Forms\Form $form) {
        return static::newEntityFromForm(\Models\Notice::constructForm($form));
    }

    /**
     * @param \Nette\Forms\Form $form
     * @param \Models\Notice $notice
     * @return \Nette\Forms\Form | \Models\Notice
     */
    public static function editNoticeFromForm(\Nette\Forms\Form $form, \Models\Notice $notice = null) {
        return static::editEntityFromForm(\Models\Notice::constructForm($form), $notice);
    }
}