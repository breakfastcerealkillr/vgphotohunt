<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vote Entity.
 */
class Vote extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
	'picture_id' => true,
	'mark_id' => true
    ];
}
