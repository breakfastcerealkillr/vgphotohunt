<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * News Entity.
 */
class News extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
	'body' => true,
	'timestamp' => true,
	'user_id' => true,
	'pic_url' => true,
        'file' => true
    ];
}
