<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Set Entity.
 */
class Set extends Entity
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
        'set_start_date' => true,
        'set_end_date' => true,
        'voting_start_date' => true,
        'voting_end_date' => true,
        'winner_user_id' => true,
        'game' => true,
        'winner_user' => true,
        'pictures' => true,
        'upvotes' => true,
    ];
}
