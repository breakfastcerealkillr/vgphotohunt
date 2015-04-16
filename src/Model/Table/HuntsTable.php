<?php

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Hunts Model
 */
class HuntsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('hunts');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Games', ['foreignKey' => 'game_id']);
        $this->hasMany('Marks', ['foreignKey' => 'hunt_id']);
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
                ->add('start_date', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('start_date')
                ->add('end_date', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('end_date')
                ->add('voting_start_date', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('voting_start_date')
                ->add('voting_end_date', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('voting_end_date');

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

    public function beforeSave($event, $entity) {
        

    }

    public function findOpenHunts($id = null) {
        
        $currentTime = Time::parse('now');
        
        $query = $this->find()
                ->contain(['Games', 'Marks'])
                ->where(['start_date <=' => $currentTime, 'end_date >=' => $currentTime])
                ->order(['start_date' => 'ASC']);
        if ($id != null) {
            $query->where(['Games.id' => $id]);
        }
        
        return $query;
        
    }

    public function findOpenVotes($id = null) {

        $currentTime = Time::parse('now');
        
        $query = $this->find()
                ->contain(['Games', 'Marks'])
                ->where(['voting_start_date <=' => $currentTime])
                ->andWhere(['voting_end_date >=' => $currentTime])
                ->order(['start_date' => 'ASC']);
        
        if ($id != null) {
            $query->where(['Games.id' => $id]);
        }

        return $query;

    }
    
    public function findPastHunts($id = null) {
        
        $currentTime = Time::parse('now');
        
        $query = $this->find()
                ->contain(['Games', 'Marks'])
                ->where(['voting_end_date <=' => $currentTime])
                ->order(['start_date' => 'ASC']);
        
        if ($id != null) {
            $query->where(['Games.id' => $id]);
        }
        return $query;
    }
    
    public function getStatus($id) {
        // Only called on a single entity, rather than a map/reduce on a whole table.
        // Can't tell which one is more 'useful', in the context of this app, though...
        $now = Time::parse('now');
        
        $query = $this
                ->find()->where(['Hunts.id' => $id])
                ->first();
            
        if ($query['start_date'] <= $now && $query['end_date'] >= $now) {
              $status = "open";} 
        else {$status = "closed";}

        if ($query['voting_start_date'] <= $now && $query['voting_end_date'] >= $now) {
              $status = "vote";} 
        else {$status = "closed";}

        return $status;
    }
        
//    public function findWithStatus() {
//
//        $query = $this->find();
//
//        $query->contain('Games');
//
//        $results = $this->statusParse($query);
//
//        return $results;
//    }
//
//    private function statusParse($query) {
//
//        if (!isset($query)) {
//            return false;
//        }
//
//        $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
//            return $results->map(function ($row) {
//
//                        $now = Time::parse('now');
//
//                        if ($row['start_date'] <= $now && $row['end_date'] >= $now) {
//                            $row['hunt_open'] = true;
//                            $row['status'] = "Hunt Open";
//                        } else {
//                            $row['hunt_open'] = false;
//                        }
//
//                        if ($row['voting_start_date'] <= $now && $row['voting_end_date'] >= $now) {
//                            $row['voting_open'] = true;
//                            $row['status'] = "Voting Open";
//                        } else {
//                            $row['voting_open'] = false;
//                        }
//
//                        return $row;
//                    });
//        });
//
//        return $query;
//    }
//
//    public function viewWithStatus($id) {
//
//        if (!isset($id)) {
//            return false;
//        }
//
//        $query = $this
//                ->find()
//                ->contain('Pictures.Users')
//                ->where(['Hunts.id' => $id])
//                ->first();
//
//        $now = Time::parse('now');
//
//        if ($query['start_date'] <= $now && $query['end_date'] >= $now) {
//            $query['hunt_open'] = true;
//            $query['status'] = "Game Open";
//        } else {
//            $query['hunt_open'] = false;
//        }
//
//        if ($query['voting_start_date'] <= $now && $query['voting_end_date'] >= $now) {
//            $query['voting_open'] = true;
//            $query['status'] = "Voting Open";
//        } else {
//            $query['voting_open'] = false;
//        }
//
//        return $query;
//    }
//
//    /*
//     * This checks if the user has completed a hunt
//     */
//
//    public function completed($id, $user_id) {
//
//        if (!isset($id) || !isset($user_id)) {
//            return false;
//        }
//
//        $this->Pictures = TableRegistry::get('Pictures');
//
//        $pictures = $this
//                ->Pictures
//                ->find()
//                ->where([
//                    'Pictures.user_id' => $user_id,
//                    'Pictures.hunt_id' => $id
//                ])
//                ->count();
//
//        if ($pictures >= 1) {
//            return true;
//        } else {
//            return false;
//        }
//    }

}
