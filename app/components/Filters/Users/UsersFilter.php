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

class UsersFilter extends \DatagridFilters\BaseFilter {

    protected $datagridSnippetName = "usersDatagrid";
    protected $defaultValues = ["showHide" => false, "sort" => "surname", "direction" => "ASC"];

    protected function constructFilterForm() {
        $this->form->addText("keyWord", "Search");
        $this->form->addCheckbox("showHide", "Show hide");
        $this->form->addSelect("sort", "Sort", ["surname" => "Surname"]);
        $this->form->addSelect("direction", "", ["ASC" => "Ascending", "DESC" => "Descending"]);
        $this->form->addSubmit("filter", "filter");
        $this->form->addSubmit("reset", "Reset")->onClick[] = callback($this, "resetFilter");
    }

    public function getSpecification() {
        $formData = $this->filterCriteria();
        $specification = new \obo\Carriers\QuerySpecification();

        if (isset($formData['keyWord']) AND $formData['keyWord']) {
            $specification->bindParameters(["keyWord" => "%" . $formData['keyWord'] . "%"]);
            $specification->where(" AND ((CONCAT({name},' ',{surname}) LIKE :keyWord)");
            $specification->where(" OR ({notices}.{text} LIKE :keyWord)");
            $specification->where(" OR ({tags}.{name} LIKE :keyWord)");
            $specification->where(" OR ({sex}.{name} LIKE :keyWord)");
            $specification->where(" OR ({contact}.{phone} LIKE :keyWord)");
            $specification->where(" OR ({contact}.{email} LIKE :keyWord)");
            $specification->where(" OR ({contact}.{address}.{street} LIKE :keyWord)");
            $specification->where(" OR ({contact}.{address}.{city} LIKE :keyWord)");
            $specification->where(" OR ({contact}.{address}.{zip} LIKE :keyWord)");
            $specification->where(")");
        }

        if (!isset($formData['showHide']) OR ! $formData['showHide']) {
            $specification->where(" AND {hide} = 0");
        }

        $specification->orderBy("{{$formData['sort']}} {$formData['direction']}");

        return $specification;
    }

}
