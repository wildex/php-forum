<?php
/**
 * @class \entities\Forum
 */

namespace entities;

/**
 * @Entity
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
}