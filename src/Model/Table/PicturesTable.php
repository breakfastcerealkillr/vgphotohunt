<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Pictures Model
 */
class PicturesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('pictures');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Marks', [
            'foreignKey' => 'mark_id'
        ]);
        $this->hasMany('PictureComments', [
            'foreignKey' => 'picture_id'
        ]);
        $this->hasMany('Votes', [
            'foreignKey' => 'picture_id'
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
                ->add('mark_id', 'valid', ['rule' => 'numeric'])
                ->requirePresence('mark_id', 'create')
                ->notEmpty('mark_id');

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
        $rules->add($rules->existsIn(['mark_id'], 'Marks'));
        return $rules;
    }

    public function beforeSave($event, $entity) {

        if (empty($entity->file['tmp_name'])) {
            return false;
        }

        $entity->guid = Text::uuid();
        $entity->date = Time::now();

        $full_image_name = 'pictures/' . $entity->guid . '.png';

        if (!imagepng(imagecreatefromstring(file_get_contents($entity->file['tmp_name'])), $full_image_name)) {
            return false;
        }

        $thumbnail_name = 'pictures/' . $entity->guid . '_thumb.png';

        $this->scale($full_image_name, $thumbnail_name);

        return true;
    }

    private function scale($filename, $save_path) {

        $width = 200;
        $height = 200;

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

    public function viewWithStatus($id) {

        if (!isset($id)) {
            return false;
        }

        $query = $this
                ->find()
                ->contain(['Users', 'Hunts', 'Marks', 'PictureComments.Users', 'Votes'])
                ->where(['Pictures.id' => $id])
                ->first();

        $now = Time::parse('now');

        if ($query->hunt->start_date <= $now && $query->hunt->end_date >= $now) {
            $query->hunt->open = true;
            $query->hunt->status = "Hunt Open";
        } else {
            $query->hunt->open = false;
        }

        if ($query->hunt->voting_start_date <= $now && $query->hunt->voting_end_date >= $now) {
            $query->hunt->voting_open = true;
            $query->hunt->status = "Voting Open";
        } else {
            $query->hunt->voting_open = false;
        }

        return $query;
    }

}
