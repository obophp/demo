<?php

/**
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011, 2012 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace DatagridFilters;

abstract class BaseFilter extends \obo\Utils\DatagridFilter {

    protected function formFactory($name) {
        $form = new \Base\Form($this, $name);
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['pair']['container'] = NULL;
        $renderer->wrappers['label']['container'] = NULL;
        $renderer->wrappers['control']['container'] = NULL;
        $renderer->wrappers['label']['suffix'] = '';
        return $form;
    }

}
