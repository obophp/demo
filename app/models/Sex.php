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
class SexProperties extends \Base\EntityProperties {
    public $name = "";
}

# definition entity

/**
 * @property string $name

 */
class Sex extends \Base\Entity{

    /**
     * @return array
     */
    public static function sexDial() {
        return array("1"=>"man", "2"=>"woman");
    }

}

# definition entity manager

class SexManager extends \Base\EntityManager{

}