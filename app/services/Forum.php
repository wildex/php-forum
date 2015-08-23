<?php
/**
 * @class services\Forum
 */

namespace services;

use core\Service;

class Forum extends Service {

    protected function create() {
        $forum = new \entity\Forum(new \DateTime('now'));
        $forum->setTitle($this->_request->param('title'));
        R()->getDBEntity()->persist($forum);
        R()->getDBEntity()->flush();
    }

    protected function read() {

    }

    protected function update() {

    }

    protected function delete() {

    }
}