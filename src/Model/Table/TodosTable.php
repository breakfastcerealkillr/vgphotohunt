<?php

namespace App\Model\Table;

use Cake\ORM\TableRegistry;

class TodosTable extends Table {
    
    private $Votes;
    private $Pictures;

    public function initialize() {
        
        $this->Votes = TableRegistry::get('Votes');
        $this->Pictures = TableRegistry::get('Pictures');
        
    }
    
    public function show($user_id = null) {
        
        if (!$user_id) {
            return false;
        }
        
    }

}
