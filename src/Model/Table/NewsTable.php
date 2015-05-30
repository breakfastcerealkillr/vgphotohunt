<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * News Model
 */
class NewsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('news');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NewsComments', [
            'foreignKey' => 'news_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create')
                ->add('user_id', 'valid', ['rule' => 'numeric'])
                ->requirePresence('user_id', 'create')
                ->notEmpty('user_id')
                ->requirePresence('file', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function beforeSave($event, $entity) {

        if (!empty($entity->file['name'])) {
            if ($entity->pic_url != null) {
                foreach (glob('newspics/' . $entity->pic_url . '*') as $file) {
                    unlink($file);
                }
            }
        }

        if (empty($entity->file['tmp_name'])) {
            return true;
        }

        $entity->pic_url = Text::uuid();

        $full_image_name = 'newspics/' . $entity->pic_url . '.png';

        if (!imagepng(imagecreatefromstring(file_get_contents($entity->file['tmp_name'])), $full_image_name)) {
            return false;
        }

        $thumb100 = 'newspics/' . $entity->pic_url . '_100.png';
        $thumb60 = 'newspics/' . $entity->pic_url . '_60.png';

        $this->scale($full_image_name, $thumb100, 100);
        $this->scale($full_image_name, $thumb60, 60);

        return true;
    }

    private function scale($filename, $save_path, $size) {

        $width = $size;
        $height = $size;

        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }


        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefrompng($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);


        return imagepng($image_p, $save_path, 0);
    }

    public function findNewest($id = null, $limit = null) {
        $query = $this->find()
                ->contain(['Users'])
                ->order(['timestamp' => 'DESC']);
        
        if ($id != null) {
            $query->where(['News.id' => $id])
            ->contain('NewsComments.Users');
        }
        if ($limit != null) {
            $query->limit($limit);
        }

        return $query;
    }

}
