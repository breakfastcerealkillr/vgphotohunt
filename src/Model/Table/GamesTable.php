<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Games Model
 */
class GamesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('games');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('Hunts', [
            'foreignKey' => 'game_id'
        ]);
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
            if ($entity->avatar !== '') {
                foreach (glob('gamepics/' . $entity->pic_url . '*') as $file) {
                    unlink($file);
                }
            }
        }

        if (empty($entity->file['tmp_name'])) {
            return true;
        }

        $entity->pic_url = Text::uuid();

        $full_image_name = 'gamepics/' . $entity->pic_url . '.png';

        if (!imagepng(imagecreatefromstring(file_get_contents($entity->file['tmp_name'])), $full_image_name)) {
            return false;
        }

        $thumb100 = 'gamepics/' . $entity->pic_url . '_100.png';
        $thumb60 = 'gamepics/' . $entity->pic_url . '_60.png';

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
}
