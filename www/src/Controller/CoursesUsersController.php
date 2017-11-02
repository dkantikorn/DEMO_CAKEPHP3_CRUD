<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoursesUsers Controller
 *
 * @property \App\Model\Table\CoursesUsersTable $CoursesUsers
 *
 * @method \App\Model\Entity\CoursesUser[] paginate($object = null, array $settings = [])
 */
class CoursesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Courses']
        ];
        $coursesUsers = $this->paginate($this->CoursesUsers);

        $this->set(compact('coursesUsers'));
        $this->set('_serialize', ['coursesUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Courses User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coursesUser = $this->CoursesUsers->get($id, [
            'contain' => ['Users', 'Courses']
        ]);

        $this->set('coursesUser', $coursesUser);
        $this->set('_serialize', ['coursesUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coursesUser = $this->CoursesUsers->newEntity();
        if ($this->request->is('post')) {
            $coursesUser = $this->CoursesUsers->patchEntity($coursesUser, $this->request->getData());
            if ($this->CoursesUsers->save($coursesUser)) {
                $this->Flash->success(__('The courses user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The courses user could not be saved. Please, try again.'));
        }
        $users = $this->CoursesUsers->Users->find('list', ['limit' => 200]);
        $courses = $this->CoursesUsers->Courses->find('list', ['limit' => 200]);
        $this->set(compact('coursesUser', 'users', 'courses'));
        $this->set('_serialize', ['coursesUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Courses User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coursesUser = $this->CoursesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coursesUser = $this->CoursesUsers->patchEntity($coursesUser, $this->request->getData());
            if ($this->CoursesUsers->save($coursesUser)) {
                $this->Flash->success(__('The courses user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The courses user could not be saved. Please, try again.'));
        }
        $users = $this->CoursesUsers->Users->find('list', ['limit' => 200]);
        $courses = $this->CoursesUsers->Courses->find('list', ['limit' => 200]);
        $this->set(compact('coursesUser', 'users', 'courses'));
        $this->set('_serialize', ['coursesUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Courses User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coursesUser = $this->CoursesUsers->get($id);
        if ($this->CoursesUsers->delete($coursesUser)) {
            $this->Flash->success(__('The courses user has been deleted.'));
        } else {
            $this->Flash->error(__('The courses user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
