<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\I18n\Time;
use Cake\Filesystem\File;

/**
 * Pictures Model
 */
class PicturesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('pictures');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Sets', [
            'foreignKey' => 'set_id'
        ]);
        $this->hasMany('PictureComments', [
            'foreignKey' => 'picture_id'
        ]);
        $this->hasMany('Upvotes', [
            'foreignKey' => 'picture_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
//    public function validationDefault(Validator $validator)
//    {
//        $validator
//            ->add('id', 'valid', ['rule' => 'numeric'])
//            ->allowEmpty('id', 'create')
//            ->add('user_id', 'valid', ['rule' => 'numeric'])
//            ->requirePresence('user_id', 'create')
//            ->notEmpty('user_id')
//            ->add('set_id', 'valid', ['rule' => 'numeric'])
//            ->requirePresence('set_id', 'create')
//            ->notEmpty('set_id')
//            ->requirePresence('guid', 'create')
//            ->notEmpty('guid')
//            ->add('date', 'valid', ['rule' => 'datetime'])
//            ->requirePresence('date', 'create')
//            ->notEmpty('date');
//
//        return $validator;
//    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['set_id'], 'Sets'));
        return $rules;
    }
    
    public function beforeSave($event, $entity) {
        
        $entity->guid = Text::uuid();
        $entity->date = Time::now();
        
        debug($entity->file['tmp_name']);die;
        
        $temp_file = new File($entity->file['tmp_name']);
        $temp_file->read();
        
        $file = new File('webroot/pictures/' . $entity->guid . '.png', true, 0644);
        $file->write($temp_file);

        return true;

    }
}
