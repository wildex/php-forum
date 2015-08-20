<?php
/**
 * @class \entities\Post
 */

namespace entities;

/**
 * @Entity
 * @Table(name="forum_post")
 */
class Post {
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     * @GeneratedValue
     */
    protected $post_id;

    /**
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     */
    protected $topic_id;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $post_title;

    /**
     * @Column(type="text", nullable=false)
     */
    protected $post_text;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $post_date_created;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $post_date_updated;
}