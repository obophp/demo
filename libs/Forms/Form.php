<?php

namespace Base;

class Form extends \Nette\Application\UI\Form {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);
        $renderer = $this->getRenderer();
        $renderer->wrappers["controls"]["container"] = "table";
    }

}
