<?php
namespace App\Model\Table;

use App\Model\Entity\Mark;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

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
        $this->belongsTo('Pictures', [
            'foreignKey' => 'winner_id',
            'propertyName' => 'winner']);
        $this->hasMany('Submissions', [
            'className' => 'Pictures',
            'foreignKey' => 'mark_id',
            'propertyName' => 'submissions']);
        $this->hasMany('Votes', ['foreignKey' => 'mark_id']);
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
            ->requirePresence('name')
            ->notEmpty('name', 'Please fill out name field.')
            ->add('hunt_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('hunt_id', 'create')
            ->notEmpty('hunt_id')
            ->add('winner_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('winner_id');

        return $validator;
    }
    
    // Gets all the winners, starting with the ones whose Hunts ended most recently.
    public function findWinners() {
         $query = $this->find()
                ->contain([
                    'Hunts',
                    'Pictures.Users' => function ($q) {
                            return $q
                            ->select(['username']);}
                        ])
                ->where(['winner_id !=' => 'NULL', 'winner_id !=' => 0])
                ->limit(5)
                ->order(['Hunts.voting_end_date' => 'DESC'])
                ->shuffle();

        return $query;
    }
    // UNTESTED CODE.
    // Used to determine which archived marks don't have a winner yet.
    public function findUnresolved() {
        
        $this->currentTime = Time::parse('now');
        
        $query = $this->find()
                ->contain([
                    'Submissions.Users' => function ($q) {
                        return $q
                        ->select(['id']);}
                    ])
                ->where(['winner_id IS' => null]);
        $query->matching('Hunts', function ($q) {
            return $q->where(['Hunts.voting_end_date <=' => $this->currentTime]);});
        return $query;
    }
    

    
    public function findByHunt($id = null, $userId = null) {
        
        // Will return all marks if no parameters are given.
        $query = $this->find()
               ->contain(['Hunts',
                   'Submissions.PictureComments.Users' => function ($q) {
                   return $q->select(['id', 'username', 'avatar', 'current_portrait']);},
                   'Submissions.Users' => function ($q) {
                   return $q->select(['id', 'username', 'avatar', 'current_portrait']);}]) // Don't need anything else yet.
                ->order(['Marks.id' => 'ASC']);
                   
        // User is logged in and the hunt ID has been given.           
        if ($id != null && $userId != null) {
            // Limit query to current hunt.
            $query->where(['Hunts.id' => $id]);

            // Get a list of marks that the user has completed / voted on. Also limited by hunt. Because reasons.
            $this->compMarks = $this->checkCompleted($id, $userId)->toArray();
            $this->voteMarks = $this->checkVoted($id, $userId)->toArray();
            // 'Thread' the results into the query result so that each mark can be checked in the view.
            $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) {
                return $results->map(function ($row) {
                    if (in_array($row['id'], $this->compMarks)) {
                          $row['completed'] = true;} 
                    else {$row['completed'] = false;}
                    return $row;
                });
            });       
            
            // 'Thread' pictures with a voted status.
            $query->contain(['Submissions' => function ($q) {
                return $q->formatResults(function ($authors) {
                    return $authors->map(function ($row) {
                   if (in_array($row['id'], $this->voteMarks)) {
                          $row['voted'] = true;} 
                    else {$row['voted'] = false;}
                    return $row;});
                });
            }]);
        }
        
        // User is not logged in, but the Hunt ID has been given.
        elseif ($id != null) {
            $query->where(['Hunts.id' => $id]);}

        return $query;
        
    }
    
    public function checkCompleted($hid, $uid) {
        $this->hid = $hid;
        $this->uid = $uid;
        
        $query = $this->find();
        $query->matching('Submissions', function ($q) {
            return $q->where(['Pictures.user_id' => $this->uid]);});
        $query->matching('Hunts', function ($q) {
            return $q->where(['Hunts.id' => $this->hid]);});
            
        $compMarks = $query->extract('Pictures.mark_id');
        
        return $compMarks;
    }
    
    // Checks by hunt rather than specific marks. 
    public function checkVoted($hid, $uid) {
        $this->hid = $hid;
        $this->uid = $uid;
        
        $query = $this->find();
        $query->matching('Submissions.Votes', function ($q) {
            return $q->where(['Votes.user_id' => $this->uid]);});
        $query->matching('Hunts', function ($q) {
            return $q->where(['Hunts.id' => $this->hid]);});
            
        $voteMarks = $query->extract('Pictures.id');
        
        return $voteMarks;
    }
    
    public function markResolver($marks) {
            $echo = ' ';
            foreach($marks as $mark) {
            
            if (empty($mark->submissions)) { // If there are no submissions...
                
                $mark->winner_id = 0; // Set the winner to something not null....
                
                if($this->save($mark)) {
                     $echo .= 'Mark ID ' . $mark->id . ' has no submissions. <br />';}
                else { $echo .= 'Mark ID ' . $mark->id . ' did not save! (No submissions) <br />';}
            }
            else {
                $topPic = $this->Pictures->rankVotes($mark->id, 1)->first(); //Find the top 1 picture per mark, by vote count
                $mark->winner_id = $topPic->id;
                if($this->save($mark)) {
                    $echo .= 'Mark ID ' . $mark->id . ' saved with winner ID ' . $mark->winner_id . '. <br />';
                }
                else {
                    $echo .= 'Mark ID ' . $mark->id . ' did not save! (' . $mark->winner_id . ') <br />';
                }
                // Now give the winners XP, levels, awards, all that jazz.
                if($this->Pictures->Users->addXp($topPic->user_id, 20) > 0) {
                    $echo .= $topPic->user->username . ' got XP. <br />';
                }
                else {
                    $echo .= $topPic->user->username . ' failed to get XP. <br />';
                }
            }
        }
        
        return $echo;
    }
    
    public function findWins($userid) {
        $this->uid = $userid;
        $query = $this->find()
            ->where(['winner_id IS NOT' => null])
            ->matching('Pictures', function ($q) {
                return $q->where(['Pictures.user_id' => $this->uid]);
            });
            
        return $query;
    }
}
