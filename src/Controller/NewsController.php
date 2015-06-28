<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * news Controller
 *
 * @property \App\Model\Table\newsTable $news
 */
class NewsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd() {
        
		$this->adminOnly();

        $news = $this->News->newEntity();

        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->data);
            if ($this->News->save($news)) {
                $this->Flash->success('The news has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'news']);
            } else {
                $this->Flash->error('The news could not be saved. Please, try again.');
            }
        }
        $this->set('author', $this->Auth->user('id'));
    }
    
    public function adminEdit($id = null) {

		$this->adminOnly();

        $news = $this->News->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->data);
            if ($this->News->save($news)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The news could not be saved. Please, try again.');
            }
        }
        $this->set('news', $news);
    }
    
    public function adminDelete($id = null) {

	$this->adminOnly();

        $entity = $this->News->get($id);
        if ($this->News->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
    
    public function deleteNewsPic($id = null) {

        
        $newspic = $this->News->get($id);

        foreach (glob('newspics/' . $newspic->pic_url . '*') as $file) {
            unlink($file);
            debug($file);
        }

        $newspic->pic_url = null;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newspic = $this->News->patchEntity($newspic, $this->request->data);
            if ($this->News->save($newspic)) {
                $this->Flash->success('Deleted!');
            } else {
                $this->Flash->error('Failed!');
            }
        }
        return $this->redirect($this->referer());
        
    }
    
    public function view($id = null) {
        
            $this->set('news', $this->News->findNewest($id));
 
    }
    
    public function index() {
        $this->set('news', $this->News->findNewest());
    }
    
}
