<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NamePrefixes Controller
 *
 * @property \App\Model\Table\NamePrefixesTable $NamePrefixes
 *
 * @method \App\Model\Entity\NamePrefix[] paginate($object = null, array $settings = [])
 */
class NamePrefixesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $namePrefixes = $this->paginate($this->NamePrefixes);

        $this->set(compact('namePrefixes'));
        $this->set('_serialize', ['namePrefixes']);
    }

    /**
     * View method
     *
     * @param string|null $id Name Prefix id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $namePrefix = $this->NamePrefixes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('namePrefix', $namePrefix);
        $this->set('_serialize', ['namePrefix']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $namePrefix = $this->NamePrefixes->newEntity();
        if ($this->request->is('post')) {
            $namePrefix = $this->NamePrefixes->patchEntity($namePrefix, $this->request->getData());
            if ($this->NamePrefixes->save($namePrefix)) {
                $this->Flash->success(__('The name prefix has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The name prefix could not be saved. Please, try again.'));
        }
        $this->set(compact('namePrefix'));
        $this->set('_serialize', ['namePrefix']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Name Prefix id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $namePrefix = $this->NamePrefixes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $namePrefix = $this->NamePrefixes->patchEntity($namePrefix, $this->request->getData());
            if ($this->NamePrefixes->save($namePrefix)) {
                $this->Flash->success(__('The name prefix has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The name prefix could not be saved. Please, try again.'));
        }
        $this->set(compact('namePrefix'));
        $this->set('_serialize', ['namePrefix']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Name Prefix id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $namePrefix = $this->NamePrefixes->get($id);
        if ($this->NamePrefixes->delete($namePrefix)) {
            $this->Flash->success(__('The name prefix has been deleted.'));
        } else {
            $this->Flash->error(__('The name prefix could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
