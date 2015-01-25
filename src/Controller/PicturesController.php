<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pictures Controller
 *
 * @property \App\Model\Table\PicturesTable $Pictures
 */
class PicturesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Sets']
        ];
        $this->set('pictures', $this->paginate($this->Pictures));
        $this->set('_serialize', ['pictures']);
    }

    /**
     * View method
     *
     * @param string|null $id Picture id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $picture = $this->Pictures->get($id, [
            'contain' => ['Users', 'Sets', 'PictureComments', 'Upvotes']
        ]);
        $this->set('picture', $picture);
        $this->set('_serialize', ['picture']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $picture = $this->Pictures->newEntity();
        if ($this->request->is('post')) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
            }
        }
        $users = $this->Pictures->Users->find('list', ['limit' => 200]);
        $sets = $this->Pictures->Sets->find('list', ['limit' => 200]);
        $this->set(compact('picture', 'users', 'sets'));
        $this->set('_serialize', ['picture']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Picture id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $picture = $this->Pictures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
            }
        }
        $users = $this->Pictures->Users->find('list', ['limit' => 200]);
        $sets = $this->Pictures->Sets->find('list', ['limit' => 200]);
        $this->set(compact('picture', 'users', 'sets'));
        $this->set('_serialize', ['picture']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Picture id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $picture = $this->Pictures->get($id);
        if ($this->Pictures->delete($picture)) {
            $this->Flash->success('The picture has been deleted.');
        } else {
            $this->Flash->error('The picture could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
