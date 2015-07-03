<?php
namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Notifications Model
 */
class NotificationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('notifications');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', ['foreignKey' => 'user_id']);
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
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id')
            ->requirePresence('text', 'create')
            ->notEmpty('text')
            ->requirePresence('url', 'create')
            ->notEmpty('url');
        return $validator;
    }

    public function beforeSave($event, $entity) {

    }
    
    public function add($uid, $type, $object, $markName = null) {
        
        $notification = $this->newEntity();
        
        $notification->user_id = $uid;
        
        if ($type == "levelup") {
            $notification->url = "users/edit/" . $object;
            $notification->text = "You've leveled up! Check out your new portrait here.";
            
        }
        elseif ($type == "huntcomment") {
            $notification->url = "hunts/view/" . $object;
            $notification->text = "A user commented on your submission of " . $markName . ".";
        }
        elseif ($type == "newspost") {
            $notification->url = "news/view/" . $object;
            $notification->text = "Hey. A news post just went up. Check it out.";
        }
        elseif ($type == "markwin") {
            $notification->url = "hunts/view/" . $object;
            $notification->text = "You won the mark '" . $markName . "'. Grats!";
        }
        
        if ($this->save($notification)) {
            return true;
        } else {
            return false;
        }    
    }
    
    public function findUnread($uid) {
        $query = $this->find()
                ->where(['user_id' => $uid, 'is_read' => 0]);
        return $query;
    }

}