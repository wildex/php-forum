<?php
/**
 * @class \entities\Thread
 */

namespace entities;

/**
 * @Entity
 */
class Topic {
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     * @GeneratedValue
     */
    protected $topic_id;

    /**
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     */
    protected $forum_id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $topic_title;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $topic_date_created;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $topic_date_updated;
}