<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Portrait Entity.
 */
class Portrait extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
		'description' => true,
		'url' => true
    ];
}
