<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * PictureComments Model
 */
class PictureCommentsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('picture_comments');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Pictures', [
            'foreignKey' => 'picture_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
                ->add('picture_id', 'valid', ['rule' => 'numeric'])
                ->requirePresence('picture_id', 'create')
                ->notEmpty('picture_id')
                ->add('user_id', 'valid', ['rule' => 'numeric'])
                ->requirePresence('user_id', 'create')
                ->notEmpty('user_id')
                ->requirePresence('comment', 'create')
                ->notEmpty('comment')
                ->add('comment', [
                    'maxLength' => [
                        'rule' => ['maxLength', 2000],
                        'message' => 'Comments cannot be too long.'
                    ]
        ]);


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
        $rules->add($rules->existsIn(['picture_id'], 'Pictures'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function beforeSave($event, $entity) {

        $entity->timestamp = Time::now();

        return true;
    }

}
