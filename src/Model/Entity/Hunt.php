<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Set Entity.
 */
class Hunt extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'game_id' => true,
        'name' => true,
        'description' => true,
        'start_date' => true,
        'end_date' => true,
        'voting_start_date' => true,
        'voting_end_date' => true,
    ];
}
