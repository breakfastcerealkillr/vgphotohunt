<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sets Model
 */
class SetsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('sets');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Games', [
            'foreignKey' => 'game_id'
        ]);
        $this->belongsTo('WinnerUsers', [
            'foreignKey' => 'winner_user_id'
        ]);
        $this->hasMany('Pictures', [
            'foreignKey' => 'set_id'
        ]);
        $this->hasMany('Upvotes', [
            'foreignKey' => 'set_id'
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
            ->add('game_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('game_id', 'create')
            ->notEmpty('game_id')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('set_start_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('set_start_date')
            ->add('set_end_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('set_end_date')
            ->add('voting_start_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('voting_start_date')
            ->add('voting_end_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('voting_end_date')
            ->add('winner_user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('winner_user_id');

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
        $rules->add($rules->existsIn(['game_id'], 'Games'));
        $rules->add($rules->existsIn(['winner_user_id'], 'WinnerUsers'));
        return $rules;
    }
}
