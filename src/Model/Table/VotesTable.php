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
 * Votes Model
 */
class VotesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
        {
            $this->table('votes');
            $this->displayField('id');
            $this->primaryKey('id');
            $this->belongsTo('Users', [
                'foreignKey' => 'user_id'
            ]);
            $this->belongsTo('Pictures', [
                'foreignKey' => 'picture_id'
            ]);
            $this->belongsTo('Marks', [
                'foreignKey' => 'mark_id'
            ]);
            
            $this->addBehavior('CounterCache', [
            'Pictures' => ['vote_count']
        ]);
	}
        
    public function validationDefault(Validator $validator)
        {
            $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

            return $validator;
        }
    
    //Checks to see if a user has voted on any picture in a mark.
    public function checkMark($userId, $markId) {
        $query = $this->find()
            ->where(['user_id' => $userId, 'mark_id' => $markId])
            ->first();
        if ($query->id != null) {
                $voteId = $query->id;
                return $voteId;
        }
        else {return null;}
    }
    
}
