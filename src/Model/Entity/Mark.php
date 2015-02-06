<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mark Entity.
 */
class Mark extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'hunt_id' => true,
        'winner_user_id' => true,
        'hunt' => true,
        'winner_user' => true,
        'pictures' => true,
    ];
}
