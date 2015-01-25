<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Picture Entity.
 */
class Picture extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'set_id' => true,
        'guid' => true,
        'date' => true,
        'user' => true,
        'set' => true,
        'picture_comments' => true,
        'upvotes' => true,
    ];
}
