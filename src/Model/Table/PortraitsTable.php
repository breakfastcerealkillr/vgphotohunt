<?php
namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Portraits Model
 */
class PortraitsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('portraits');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function beforeSave($event, $entity) {

        if (!empty($entity->file['name'])) {
            if ($entity->pic_url !== '') {
                foreach (glob('portraits/' . $entity->pic_url . '*') as $file) {
                    unlink($file);
                }
            }
        }

        if (empty($entity->file['tmp_name']) && empty($entity->file2['tmp_name'])) {
            return true;
        }

        $entity->pic_url = Text::uuid();

        $full_image_name = 'portraits/' . $entity->pic_url . '.png';
        $comment_image_name = 'portraits/' . $entity->pic_url . '_small.png';
        if (!imagepng(imagecreatefromstring(file_get_contents($entity->file['tmp_name'])), $full_image_name)) {
            return false;
        }
        if (!imagepng(imagecreatefromstring(file_get_contents($entity->file2['tmp_name'])), $comment_image_name)) {
            return false;
        }

        return true;
    }

}