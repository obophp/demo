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

    public function getWhere() {
        $data = $this->filterCriteria();
        $query = array();
        
        if (isset($data['keyWord']) AND $data['keyWord']){
            $query[] = " AND (CONCAT({name},' ',{surname}) LIKE %~like~)";
            $query[] = $data['keyWord'];
            
            $query[] = " OR ({notices}.{text} LIKE %~like~)";
            $query[] = $data['keyWord'];
            
            $query[] = " OR ({tags}.{name} LIKE %~like~)";
            $query[] = $data['keyWord'];
            
            $query[] = " OR ({sex}.{name} LIKE %~like~)";
            $query[] = $data['keyWord'];
        }  
        
        if (!isset($data['showHide']) OR !$data['showHide']){
            $query[] = " AND {hide} = 0";   
        }
                
        return $query;
    }
    
    public function getOrderBy() { 
        $data = $this->filterCriteria();
        return array("{{$data['sort']}} {$data['direction']}");
    }
}