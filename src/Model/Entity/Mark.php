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
        'name' => true,
        'hunt_id' => true,
        'winner_id' => true
    ];
}
