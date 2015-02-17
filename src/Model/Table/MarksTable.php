<?php
namespace App\Model\Table;

use App\Model\Entity\Mark;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Marks Model
 */
class MarksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('marks');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Hunts', [
            'foreignKey' => 'hunt_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'winner_id'
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
            ->add('hunt_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('hunt_id', 'create')
            ->notEmpty('hunt_id')
            ->add('winner_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('winner_id');

        return $validator;
    }

}
