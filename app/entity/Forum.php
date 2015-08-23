<?php
/**
 * @class \entity\Forum
 */

namespace entity;

/**
 * @Entity
 * @Table(name="forum_forum")
 */
class Forum {
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     * @GeneratedValue
     */
    protected $forum_id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $forum_title;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $forum_date_created;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $forum_date_updated;

    public function __construct(\DateTime $current_date) {
        $this->forum_date_updated = $this->forum_date_created = $current_date;
    }

    /**
     * @param $title string
     */
    public function setTitle($title) {
        $this->forum_title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->forum_title;
    }
}