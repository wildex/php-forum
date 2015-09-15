<?php
/**
 * @class \entity\UserGroups
 */

namespace entity;

/**
 * @Entity
 * @Table(name="forum_user_group")
 */
class UserGroup {

    /**
     * @Id
     * @Column(type="integer", length=10, nullable=false, options={"unsigned"=true})
     * @GeneratedValue
     */
    protected $group_id;

    /**
     * @Column(type="string", length=64, nullable=false)
     */
    protected $group_name;

    /**
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $group_rights;

}