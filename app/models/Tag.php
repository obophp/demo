<?php

/** 
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011 - 2013 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Tag;

# A class defining the entity is usually better to split into its own file. Here are clarity placed in one file

# definition of properties

class TagProperties extends \Base\Properties{
    public $id = 0;
    public $name = "";
    public $deleted = false;
}

# definition entity

/**
 * @property int $id
 * @property mixed $name 
 */
class Tag extends \Base\Entity{
    
    /**
     * @param \Nette\Forms\Form $form
     * @return \Nette\Forms\Form 
     */
    public static function constructForm(\Nette\Forms\Form $form) {
        $form->addText('name', "New tag");
        $form->addSelect("tagId", null,  self::tagsDial())->setPrompt("Or select");
        return $form;
    }
    
    /**
     * @return array 
     */
    public static function tagsDial() {
        $tagsDial = array();
        foreach(\Tag\TagManager::tags() as $tag) $tagsDial[$tag->id] = $tag->name;
        return $tagsDial;
    }
    
}

# definition entity manager

class TagManager extends \Base\Manager{
    
    /**
     * @param array|int|null $specification
     * @return \Tag\Tag 
     */
    public static function tag($specification) {
        return self::entity($specification);
    }
    
    /**
     * @param \obo\Interfaces\IPaginator $paginator
     * @param \obo\Interfaces\IFilter $filter
     * @return \Tag\Tag[]
     */
    public static function tags(\obo\Interfaces\IPaginator $paginator = null, \obo\Interfaces\IFilter $filter = null) {
        return self::findEntities(new \obo\Carriers\QueryCarrier(), $paginator, $filter);
    }
    
    /**
     * @param \Nette\Forms\Form $form
     * @param \Users\User $user
     * @return \Nette\Forms\Form|\Tag\Tag 
     */
    public static function addTagToUserFromForm(\Nette\Forms\Form $form, \Users\User $user) {
        $form = \Tag\Tag::constructForm($form);
        $form->addSubmit("add", "Add");
        if ($form->isSubmitted() AND $form->isValid()) {
            if (isset($form->values["name"]) AND $form->values["name"]) { 
                return $user->tags->add(\Tag\TagManager::tag(array("name" => $form["name"]->value))->save());
            } else {
                return $user->tags->add(\Tag\TagManager::tag($form["tagId"]->value));
            }
        } 
    }   
}