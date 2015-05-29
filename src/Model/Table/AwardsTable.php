<?php
namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Awards Model
 */
class AwardsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('awards');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Portraits', [
            'foreignKey' => 'portrait_id'
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
    // Find possible portraits based on awards given.
    public function findPortraits($id) {
        $query = $this->find()
                ->contain(['Portraits'])
                ->where(['user_id' => $id]);
        
        $combined = $query->combine('portrait.pic_url', 'portrait.name');
        return $combined;
    }
    
    public function addAward($uid, $pid) {
        
        $award = $this->newEntity();
        $award->user_id = $uid;
        $award->portrait_id = $pid;
        $award->timestamp = Time::now();
        
        if ($this->save($award)) {
                return true;
        } else {
                return false;
            }
        }
}
