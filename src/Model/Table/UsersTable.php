<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Steams', [
            'foreignKey' => 'steam_id'
        ]);
        $this->hasMany('PictureComments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Pictures', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Upvotes', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->requirePresence('username_canonical', 'create')
            ->notEmpty('username_canonical')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->requirePresence('email_canonical', 'create')
            ->notEmpty('email_canonical')
            ->add('enabled', 'valid', ['rule' => 'boolean'])
            ->requirePresence('enabled', 'create')
            ->notEmpty('enabled')
            ->requirePresence('salt', 'create')
            ->notEmpty('salt')
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->add('last_login', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('last_login')
            ->add('locked', 'valid', ['rule' => 'boolean'])
            ->requirePresence('locked', 'create')
            ->notEmpty('locked')
            ->add('expired', 'valid', ['rule' => 'boolean'])
            ->requirePresence('expired', 'create')
            ->notEmpty('expired')
            ->add('expires_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('expires_at')
            ->allowEmpty('confirmation_token')
            ->add('password_requested_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('password_requested_at')
            ->requirePresence('roles', 'create')
            ->notEmpty('roles')
            ->add('credentials_expired', 'valid', ['rule' => 'boolean'])
            ->requirePresence('credentials_expired', 'create')
            ->notEmpty('credentials_expired')
            ->add('credentials_expire_at', 'valid', ['rule' => 'datetime'])
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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['steam_id'], 'Steams'));
        return $rules;
    }
}
