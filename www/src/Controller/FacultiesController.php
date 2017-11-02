<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Faculties Controller
 *
 * @property \App\Model\Table\FacultiesTable $Faculties
 *
 * @method \App\Model\Entity\Faculty[] paginate($object = null, array $settings = [])
 */
class FacultiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $faculties = $this->paginate($this->Faculties);

        $this->set(compact('faculties'));
        $this->set('_serialize', ['faculties']);
    }

    /**
     * View method
     *
     * @param string|null $id Faculty id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $faculty = $this->Faculties->get($id, [
            'contain' => ['Courses', 'Users']
        ]);

        $this->set('faculty', $faculty);
        $this->set('_serialize', ['faculty']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faculty = $this->Faculties->newEntity();
        if ($this->request->is('post')) {
            $faculty = $this->Faculties->patchEntity($faculty, $this->request->getData());
            if ($this->Faculties->save($faculty)) {
                $this->Flash->success(__('The faculty has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faculty could not be saved. Please, try again.'));
        }
        $this->set(compact('faculty'));
        $this->set('_serialize', ['faculty']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Faculty id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $faculty = $this->Faculties->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $faculty = $this->Faculties->patchEntity($faculty, $this->request->getData());
            if ($this->Faculties->save($faculty)) {
                $this->Flash->success(__('The faculty has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faculty could not be saved. Please, try again.'));
        }
        $this->set(compact('faculty'));
        $this->set('_serialize', ['faculty']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Faculty id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faculty = $this->Faculties->get($id);
        if ($this->Faculties->delete($faculty)) {
            $this->Flash->success(__('The faculty has been deleted.'));
        } else {
            $this->Flash->error(__('The faculty could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
