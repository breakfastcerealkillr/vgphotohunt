<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'username_canonical' => true,
        'email' => true,
        'email_canonical' => true,
        'enabled' => true,
        'salt' => true,
        'password' => true,
        'last_login' => true,
        'locked' => true,
        'expired' => true,
        'expires_at' => true,
        'confirmation_token' => true,
        'password_requested_at' => true,
        'roles' => true,
        'credentials_expired' => true,
        'credentials_expire_at' => true,
        'steam_id' => true,
        'avatar' => true,
        'steam' => true,
    ];
}
