<?php

/**
 * This file is part of demo application for example of using framework Obo beta 2 version (http://www.obophp.org/)
 * Created under supervision of company as CreatApps (http://www.creatapps.cz/)
 * @link http://www.obophp.org/
 * @author Adam Suba, http://www.adamsuba.cz/
 * @copyright (c) 2011 - 2013 Adam Suba
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class HomepagePresenter extends \Nette\Application\UI\Presenter {

    public function renderDefault() {
        # assign set of User entities to template, set is influenced by current status paginator and filter
        $this->template->users = \Models\UserManager::users($this["paginator"], $this["filter"]);
    }

    public function renderDetail($userId) {
        # assign User entity to template
        $this->template->user = $user = \Models\UserManager::user($userId);
        # notify event "onViewInDetail" for User entity
        $user->notifyEvent("onViewInDetail");
    }

    public function renderEdit($userId) {
        # assign User entity to template
        $this->template->user = \Models\UserManager::user($userId);
    }

    public function handleDelete($userId) {
        # remove entity
        \Models\UserManager::user($userId)->delete();
        $this->flashMessage("User has been removed", "success");
        $this->redirect("this");
    }

    public function renderAddNotice($userId) {
        # assign User entity to template
        $this->template->user = \Models\UserManager::user($userId);
    }

    public function renderEditNotice($noticeId) {
        # assign Notice entity to template
        $this->template->notice = \Models\Notices\NoticeManager::notice($noticeId);
    }

    public function handleDeleteNotice($noticeId) {
        # remove entity
        $notice = \Models\Notices\NoticeManager::notice($noticeId);
        $notice->owner->notices->remove($notice, true);
        $this->flashMessage("Notice has been removed", "success");
        $this->redirect("this");
    }

    public function handleDeleteTagFromUser($tagId, $userId) {
        # remove tag
        \Models\UserManager::user($userId)->tags->remove(\Models\TagManager::tag($tagId));
        $this->flashMessage("Tag has been removed", "success");
        $this->redirect("this");
    }

    protected function createComponentTagForm($name) {
        # create form for insertion Tag to User, if form is send it is processed
        $form = new \Base\Form($this, $name);

        if ($tag = \Models\TagManager::addTagToUserFromForm($form, \Models\UserManager::user($this->params["userId"]))) {
            $this->flashMessage("Tag with name '" . $tag->name . "' is added", "success");
            $this->redirect("this");
        }

        return $form;
    }

    protected function createComponentAddUserForm($name) {
        # create form for new User, if form is send it is processed
        $form = new \Base\Form($this, $name);

        if ($user = \Models\UserManager::newUserFromForm($form)) {
            $this->flashMessage("The user {$user->name} {$user->surname} was created", "success");
            $this->redirect("detail", $user->id);
        }

        return $form;
    }

    protected function createComponentEditUserForm($name) {
        # create form for edit User, if form is send it is processed
        $form = new \Base\Form($this, $name);

        if ($user = \Models\UserManager::editUserFromForm($form, \Models\UserManager::user($this->params["userId"]))) {
            $this->flashMessage("The user {$user->name} {$user->surname} was updated", "success");
            $this->redirect("detail", $user->id);
        }

        return $form;
    }

    protected function createComponentAddNoticeForm($name) {
        # create form for insertion Notice to User, if form is send it is processed
        $form = new \Base\Form($this, $name);

        if ($notice = \Models\Notices\NoticeManager::newNoticeFromForm($form)) {
            \Models\UserManager::user($this->params["userId"])->notices->add($notice);
            $this->flashMessage("Note has been added", "success");
            $this->redirect("detail", $this->params["userId"]);
        }

        return $form;
    }

    protected function createComponentEditNoticeForm($name) {
        # create form for edit Notice, if form is send it is processed
        $form = new \Base\Form($this, $name);

        if ($notice = \Models\Notices\NoticeManager::editNoticeFromForm($form, \Models\Notices\NoticeManager::notice($this->params["noticeId"]))) {
            $this->flashMessage("The notice was updated", "success");
            $this->redirect("detail", $notice->owner->id);
        }

        return $form;
    }

    protected function createComponentFilter($name) {
        # create component filter for defaul list
        return new \DatagridFilters\UsersFilter($this, $name);
    }

    protected function createComponentPaginator($name) {
        # create component paginator for defaul list
        $paginator = new \Components\Paginator($this, $name);
        return $paginator->setItemsPerPage(15);
    }

    protected function createComponentNoticePaginator($name) {
        # create component paginator for notices list
        $paginator = new \Components\Paginator($this, $name);
        return $paginator->setItemsPerPage(5);
    }

}
