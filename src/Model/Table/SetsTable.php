<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Sets Model
 */
class SetsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('sets');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Games', [
            'foreignKey' => 'game_id'
        ]);
        $this->hasMany('Pictures', [
            'foreignKey' => 'set_id'
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
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['game_id'], 'Games'));
        return $rules;
    }

    public function findWithStatus() {

        $query = $this->find();

        $query->contain('Games');

        $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
            return $results->map(function ($row) {

                        $now = Time::parse('now');

                        if ($row['set_start_date'] <= $now && $row['set_end_date'] >= $now) {
                            $row['set_open'] = true;
                            $row['status'] = "Game Open";
                        } else {
                            $row['set_open'] = false;
                        }

                        if ($row['voting_start_date'] <= $now && $row['voting_end_date'] >= $now) {
                            $row['voting_open'] = true;
                            $row['status'] = "Voting Open";
                        } else {
                            $row['voting_open'] = false;
                        }

                        return $row;
                    });
        });

        return $query;
    }

    public function viewWithStatus($id) {

        if (!isset($id)) {
            return false;
        }

        $query = $this
                ->find()
                ->contain('Pictures.Users')
                ->where(['Sets.id' => $id])
                ->first();

        $now = Time::parse('now');

        if ($query['set_start_date'] <= $now && $query['set_end_date'] >= $now) {
            $query['set_open'] = true;
            $query['status'] = "Game Open";
        } else {
            $query['set_open'] = false;
        }

        if ($query['voting_start_date'] <= $now && $query['voting_end_date'] >= $now) {
            $query['voting_open'] = true;
            $query['status'] = "Voting Open";
        } else {
            $query['voting_open'] = false;
        }

        return $query;
    }

    /*
     * This checks if the user has completed a set
     */
    public function completed($id, $user_id) {

        if (!isset($id) || !isset($user_id)) {
            return false;
        }

        $this->Pictures = TableRegistry::get('Pictures');

        $pictures = $this
                ->Pictures
                ->find()
                ->where([
                    'Pictures.user_id' => $user_id,
                    'Pictures.set_id' => $id
                ])
                ->count();

        if ($pictures >= 1) {
            return true;
        } else {
            return false;
        }
    }

}
