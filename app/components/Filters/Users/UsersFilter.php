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

class UsersFilter extends \DatagridFilters\BaseFilter{
    protected $datagridSnippetName = "usersDatagrid";
    protected $defaultValues = array("showHide" => false, "sort" => "surname", "direction" => "ASC");

    protected function constructFilterForm() {
        $this->form->addText("keyWord", "Search");
        $this->form->addCheckbox("showHide", "Show hide");
        $this->form->addSelect("sort","Sort", array("surname" => "Surname"));
        $this->form->addSelect("direction","", array("ASC" => "Ascending", "DESC" => "Descending"));
        $this->form->addSubmit("reset", "Reset")->onClick[] = callback($this, "resetFilter");
        $this->form->addSubmit("filter", "filter");
    }

    public function getSpecification() {
        $formData = $this->filterCriteria();
        $specification = new \obo\Carriers\QuerySpecification();

        # select set

        if (isset($formData['keyWord']) AND $formData['keyWord']){
            $specification->where(" AND (CONCAT({name},' ',{surname}) LIKE %~like~)", $formData['keyWord']);
            $specification->where(" OR ({notices}.{text} LIKE %~like~)", $formData['keyWord']);
            $specification->where(" OR ({tags}.{name} LIKE %~like~)", $formData['keyWord']);
            $specification->where(" OR ({sex}.{name} LIKE %~like~)", $formData['keyWord']);
        }

        if (!isset($formData['showHide']) OR !$formData['showHide']) {
            $specification->where(" AND {hide} = 0");
        }

        # ordering

        $specification->orderBy("{{$formData['sort']}} {$formData['direction']}");

        return $specification;
    }
}