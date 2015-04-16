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
        $this->belongsTo('Hunts', ['foreignKey' => 'hunt_id']);
        $this->hasMany('Pictures');
        $this->hasOne('Winners', [
            'className' => 'Pictures',
            'propertyName' => 'winner']);
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
    
    public function findWinners() {
         $query = $this->find()
                ->contain([
                    'Winners.Users' => function ($q) {
                            return $q
                            ->select(['username']);}
                        ])
                ->where(['winner_id !=' => 'NULL'])
                ->limit(5)
                ->order(['RAND()']);

        return $query;
    }
    
    public function findByHunt($id = null, $user_id = null) {
        

        
        $query = $this->find()
               ->contain(['Hunts',
                   'Pictures' => function ($q) {
                    return $q->formatResults(function ($pics) {
                        return $pics->map(function ($pic) {
                            
                            if ($pic['user_id'] === $user_id) {
                                $pic['completed'] = true;
                            }
                            else {$pic['completed'] = false;}
                            return $pic;
                            });
                        });
                    }])
                ->order(['Marks.id' => 'ASC']);
        
        if ($id != null) {
            $query->where(['Hunts.id' => $id]);
        }

        
        
        return $query;
        
    }
}
