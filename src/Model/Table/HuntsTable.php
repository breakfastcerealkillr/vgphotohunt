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
        $this->hasMany('Marks', ['foreignKey' => 'hunt_id',
            'dependent' => true]);
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

    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data) {
        
        $data['start_date'] = new Time($data['start_date'] . " 00:00:00", $data['timezone']);
        $data['start_date']->timezone = 'UTC';
        $data['end_date'] = new Time($data['end_date'] . " 23:59:59", $data['timezone']);
        $data['end_date']->timezone = 'UTC';
        $data['voting_start_date'] = new Time($data['voting_start_date'] . " 00:00:00", $data['timezone']);
        $data['voting_start_date']->timezone = 'UTC';
        $data['voting_end_date'] = new Time($data['voting_end_date'] . " 23:59:59", $data['timezone']);
        $data['voting_end_date']->timezone = 'UTC';
        
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
    
    public function findPastHunts($id = null, $limit = null) {
        
        $currentTime = Time::parse('now');
        
        $query = $this->find()
                ->contain(['Games', 'Marks'])
                ->where(['voting_end_date <=' => $currentTime])
                ->order(['voting_end_date' => 'DESC']);
        
        if ($id != null) {
            $query->where(['Games.id' => $id]);
        }
        
        if ($limit != null) {
            $query->limit($limit);
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
              $status['subs'] = "open";} 
        else {$status['subs'] = "closed";}

        if ($query['voting_start_date'] <= $now && $query['voting_end_date'] >= $now) {
              $status['vote'] = "open";} 
        else {$status['vote'] = "closed";}

        return $status;
    }
}
