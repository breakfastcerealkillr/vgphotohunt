<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vote Entity.
 */
class Vote extends Entity
{
    protected $_accessible = [
        'user_id' => true,
	'picture_id' => true,
	'mark_id' => true
    ];
}
