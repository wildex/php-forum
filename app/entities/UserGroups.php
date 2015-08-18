<?php
/**
 * @class \entities\UserGroups
 */

namespace entities;

/**
 * @Entity
 */
class UserGroups {

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