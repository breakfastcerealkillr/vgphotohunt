<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Award Entity.
 */
class Award extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
	'portrait_id' => true,
	'timestamp' => true
    ];
}
