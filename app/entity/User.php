<?php
/**
 * @class \entity\User
 */

namespace entity;

/**
 * @Entity
 * @Table(name="forum_user")
 */
class User {
    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     * @GeneratedValue
     */
    protected $user_id;

    /**
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     */
    protected $group_id;

    /**
     * @Column(type="string", length=64, nullable=false)
     */
    protected $user_name;

    /**
     * @Column(type="string", length=64, nullable=false)
     */
    protected $user_email;

    /**
     * @Column(type="string", length=64, nullable=false)
     */
    protected $user_password;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $user_date_created;

    /**
     * @Column(type="datetime", nullable=false)
     */
    protected $user_date_updated;
}