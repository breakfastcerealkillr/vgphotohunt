<?php

namespace App\Model\Table;

use Cake\Auth\DigestAuthenticate;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Users Model
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');
        $this->hasMany('PictureComments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Pictures', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Votes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Awards', ['foreignKey' => 'user_id']);
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
                ->requirePresence('username', 'create')
                ->requirePresence('email', 'create')
                ->notEmpty('username')
                ->allowEmpty('credentials_expire_at')
                ->allowEmpty('steam_id')
                ->allowEmpty('avatar');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

    public function findEnabled(Query $query) {
        $query->where([
            'Users.enabled' => true]);
        return $query;
    }

    public function findDisabled(Query $query) {
        $query->where([
            'Users.enabled' => false]);
        return $query;
    }

    public function beforeMarshal(Event $event, \ArrayObject $data) {
        if (isset($data['password'])) {
            if (empty($data['password'])) {
                unset($data['password']);
            }
        }
    }

    public function beforeSave($event, $entity) {

        if ($entity->isNew()) {
            $entity->confirmation_token = rand(100000000000000, 999999999999999);
        }

        if (!empty($entity->file['name'])) {
            if ($entity->avatar != null) {
                foreach (glob('avatars/' . $entity->avatar . '*') as $file) {
                    unlink($file);
                }
            }
        }

        if (empty($entity->file['tmp_name'])) {
            return true;
        }

        $entity->avatar = Text::uuid();

        $full_image_name = 'avatars/' . $entity->avatar . '.png';

        if (!imagepng(imagecreatefromstring(file_get_contents($entity->file['tmp_name'])), $full_image_name)) {
            return false;
        }

        $thumb100 = 'avatars/' . $entity->avatar . '_100.png';
        $thumb60 = 'avatars/' . $entity->avatar . '_60.png';

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

    public function lastLogin($user_id = null) {

        if (!$user_id) {
            return false;
        }

        $user = $this->get($user_id);

        $user->last_login = Time::now();

        if ($this->save($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function addXP($user_id, $amount) {

        $user = $this->get($user_id);

        $user->xp += $amount;


        $leveled = $this->checkLevel($user);
        if ($this->save($user)) {
            return $leveled + 1;
        } else {
            return false;
        }
    }

    //Dirty hard values in lieu of another table or something. No one's gonna hit lv11 anyway!
    public function checkLevel($user) {
        if ($user->level == 1 && $user->xp > 104) {
            $user->level += 1;
            $user->next_level = 174;
            $user->xp -= 104;
            $this->Awards->addAward($user->id, 5);
            return 1;
        } elseif ($user->level == 2 && $user->xp > 174) {
            $user->level += 1;
            $user->next_level = 284;
            $user->xp -= 174;
            $this->Awards->addAward($user->id, 6);
            return 1;
        } elseif ($user->level == 3 && $user->xp > 284) {
            $user->level += 1;
            $user->next_level = 436;
            $user->xp -= 284;
            $this->Awards->addAward($user->id, 7);
            return 1;
        } elseif ($user->level == 4 && $user->xp > 436) {
            $user->level += 1;
            $user->next_level = 633;
            $user->xp -= 436;
            $this->Awards->addAward($user->id, 8);
            return 1;
        } elseif ($user->level == 5 && $user->xp > 633) {
            $user->level += 1;
            $user->next_level = 878;
            $user->xp -= 633;
            $this->Awards->addAward($user->id, 5);
            return 1;
        } elseif ($user->level == 6 && $user->xp > 878) {
            $user->level += 1;
            $user->next_level = 1174;
            $user->xp -= 878;
            return 1;
        } elseif ($user->level == 7 && $user->xp > 1174) {
            $user->level += 1;
            $user->next_level = 1524;
            $user->xp -= 1174;
            return 1;
        } elseif ($user->level == 8 && $user->xp > 1524) {
            $user->level += 1;
            $user->next_level = 1931;
            $user->xp -= 1524;
            return 1;
        } elseif ($user->level == 9 && $user->xp > 1931) {
            $user->level += 1;
            $user->next_level = 5000;
            $user->xp -= 1931;
            return 1;
        } else {
            return 0;
        }
    }

    public function verify($token) {

        if (!isset($token)) {
            return false;
        }

        $user = $this->find()
                ->where(['Users.confirmation_token' => $token])
                ->first();

        $user->verified = true;

        if (!$this->save($user)) {
            return false;
        }

        return true;
    }

    public function isVerified($id) {

        if (!isset($id)) {
            return false;
        }

        $user = $this->get($id);

        if (!$user->verified) {
            return false;
        }

        return true;
    }

}
