<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PictureComment Entity.
 */
class PictureComment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'picture_id' => true,
        'user_id' => true,
        'comment' => true,
        'timestamp' => true
    ];
}
