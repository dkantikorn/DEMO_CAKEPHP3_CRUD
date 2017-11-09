<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 *
 * Positions Controller
 * @author  pakgon.Ltd
 * @property \App\Model\Table\PositionsTable $Positions
 * @method \App\Model\Entity\Position[] paginate($object = null, array $settings = [])
 * @since   2017-11-09 05:07:21
 * @license Pakgon.Ltd
 */
 
class PositionsController extends AppController {

    /**
     *
     * Index method make list for Position.
     * @author  pakgon.Ltd
     * @return \Cake\Http\Response|void
     * @since   2017-11-09 05:07:21
     * @license Pakgon.Ltd
     */
    public function index() {
        $positions = $this->paginate($this->Positions);

        $this->set(compact('positions'));
        $this->set('_serialize', ['positions']);
    }

    /**
     *
     * View method make for view information of Position.
     * @author  pakgon.Ltd
     * @param   string|null $id Position id.
     * @return  \Cake\Http\Response|void
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-09 05:07:21
     * @license Pakgon.Ltd
     */
    public function view($id = null) {
        $position = $this->Positions->get($id, [
            'contain' => []
        ]);

        $this->set('position', $position);
        $this->set('_serialize', ['position']);
    }

    /**
     *
     * Add method make for insert or add new Position.
     * @author  pakgon.Ltd  
     * @return  \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @since   2017-11-09 05:07:21
     * @license Pakgon.Ltd
     */
    public function add() {
        $position = $this->Positions->newEntity();
        if ($this->request->is('post')) {
            $position = $this->Positions->patchEntity($position, $this->request->getData());
            if ($this->Positions->save($position)) {
                $this->Flash->success(__('The position has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The position could not be saved. Please, try again.'));
        }
        
        $this->set(compact('position'));
        $this->set('_serialize', ['position']);
    }

    /**
     *
     * Edit method make for update Position.
     * @author  pakgon.Ltd
     * @param   string|null $id Position id.
     * @return  \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws  \Cake\Network\Exception\NotFoundException When record not found.
     * @since   2017-11-09 05:07:21
     * @license Pakgon.Ltd
     */
    public function edit($id = null) {
        $position = $this->Positions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $position = $this->Positions->patchEntity($position, $this->request->getData());
            if ($this->Positions->save($position)) {
                $this->Flash->success(__('The position has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The position could not be saved. Please, try again.'));
        }
        
        $this->set(compact('position'));
        $this->set('_serialize', ['position']);
    }

    /**
     *
     * Delete method make for delete record of Position.
     * @author  pakgon.Ltd
     * @param   string|null $id Position id.
     * @return  \Cake\Http\Response|null Redirects to index.
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-09 05:07:21
     * @license Pakgon.Ltd
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $position = $this->Positions->get($id);
        if ($this->Positions->delete($position)) {
            $this->Flash->success(__('The position has been deleted.'));
        } else {
            $this->Flash->error(__('The position could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
