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

class TagProperties extends \Base\EntityProperties {

    public $name = "";

    public $deleted = false;

}

# definition entity

/**
 * @obo-repositoryName(tag)
 * @obo-name(Tag)
 * @obo-softDeletable
 * @property string $name
 * @property boolean $deleted
 */
class Tag extends \Base\Entity {

    /**
     * @param \Base\Form $form
     * @return \Base\Form
     */
    public static function constructForm(\Base\Form $form) {
        $form->addText("name", "New tag");
        $form->addSelect("tagId", null, static::tagsDial())->setPrompt("Or select");
        return $form;
    }

    /**
     * @return array
     */
    public static function tagsDial() {
        $tagsDial = [];
        foreach (\Models\TagManager::tags() as $tag)
            $tagsDial[$tag->id] = $tag->name;
        return $tagsDial;
    }

}

# definition entity manager

class TagManager extends \Base\EntityManager {

    /**
     * @param array|int $specification
     * @return \Models\Tag
     */
    public static function tag($specification) {
        return static::entity($specification);
    }

    /**
     * @param \obo\Interfaces\IPaginator $paginator
     * @param \obo\Interfaces\IFilter $filter
     * @return \Models\Tag
     */
    public static function tags(\obo\Interfaces\IPaginator $paginator = null, \obo\Interfaces\IFilter $filter = null) {
        return static::findEntities(static::querySpecification(), $paginator, $filter);
    }

    /**
     * @param \Base\Form $form
     * @param \Models\User $user
     * @return \Base\Form|\Models\Tag
     */
    public static function addTagToUserFromForm(\Base\Form $form, \Models\User $user) {
        $form = \Models\Tag::constructForm($form);
        $form->addSubmit("add", "Add");
        if ($form->isSubmitted() AND $form->isValid()) {

            if (isset($form->values["name"]) AND $form->values["name"]) {
                return $user->tags->addNew(["name" => $form["name"]->value]);
            } else {
                return $user->tags->add(\Models\TagManager::tag($form["tagId"]->value));
            }
        }
    }

}
