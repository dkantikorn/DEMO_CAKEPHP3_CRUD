<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\FacultiesTable|\Cake\ORM\Association\BelongsTo $Faculties
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\NamePrefixesTable|\Cake\ORM\Association\BelongsTo $NamePrefixes
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsToMany $Courses
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

//        $this->setSchema('system');
        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
//$this->table($this->connection()->config()['database'] . '.tableName');
//        $this->hasOne('Faculties', [
//            'foreignKey' => 'faculty_id',
//            'conditions' => ['Profile.published' => '1'],
//            'dependent' => true
//        ]);

        $this->belongsTo('Faculties', [
            'foreignKey' => 'faculty_id'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->belongsTo('NamePrefixes', [
            'foreignKey' => 'name_prefix_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Courses', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'course_id',
            'joinTable' => 'courses_users'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('ref_code')
                ->allowEmpty('ref_code');

        $validator
                ->scalar('username')
                ->requirePresence('username', 'create')
                ->notEmpty('username');

        $validator
                ->scalar('password')
                ->requirePresence('password', 'create')
                ->notEmpty('password');

        $validator
                ->scalar('first_name')
                ->requirePresence('first_name', 'create')
                ->notEmpty('first_name');

        $validator
                ->scalar('last_name')
                ->requirePresence('last_name', 'create')
                ->notEmpty('last_name');

        $validator
                ->email('email')
                ->allowEmpty('email');

        $validator
                ->scalar('office_phone')
                ->allowEmpty('office_phone');

        $validator
                ->scalar('mobile_phone')
                ->allowEmpty('mobile_phone');

        $validator
                ->date('birth_date')
                ->allowEmpty('birth_date');

        $validator
                ->scalar('address')
                ->allowEmpty('address');

        $validator
                ->scalar('moo')
                ->allowEmpty('moo');

        $validator
                ->scalar('road')
                ->allowEmpty('road');

        $validator
                ->scalar('sub_district')
                ->allowEmpty('sub_district');

        $validator
                ->scalar('district')
                ->allowEmpty('district');

        $validator
                ->scalar('province')
                ->allowEmpty('province');

        $validator
                ->scalar('zipcode')
                ->allowEmpty('zipcode');

        $validator
                ->scalar('status')
                ->allowEmpty('status');

        $validator
                ->scalar('picture_path')
                ->allowEmpty('picture_path');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['faculty_id'], 'Faculties'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['name_prefix_id'], 'NamePrefixes'));

        return $rules;
    }

}
