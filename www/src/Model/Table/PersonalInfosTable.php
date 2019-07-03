<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PersonalInfos Model
 *
 * @method \App\Model\Entity\PersonalInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\PersonalInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PersonalInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PersonalInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalInfo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PersonalInfosTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('personal_infos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
//        $validator
//                ->allowEmpty('id', 'create');
//
//        $validator
//                ->scalar('card_no')
//                ->allowEmpty('card_no');
//
//        $validator
//                ->scalar('ref_no')
//                ->allowEmpty('ref_no');
//
//        $validator
//                ->scalar('name_prefix')
//                ->allowEmpty('name_prefix');
//
//        $validator
//                ->scalar('first_name')
//                ->allowEmpty('first_name');
//
//        $validator
//                ->scalar('last_name')
//                ->allowEmpty('last_name');
//
//        $validator
//                ->scalar('gender')
//                ->allowEmpty('gender');
//
//        $validator
//                ->date('date_of_birth')
//                ->allowEmpty('date_of_birth');
//
//        $validator
//                ->scalar('marital_status')
//                ->allowEmpty('marital_status');
//
//        $validator
//                ->scalar('blood_group')
//                ->allowEmpty('blood_group');
//
//        $validator
//                ->scalar('physical_status')
//                ->allowEmpty('physical_status');
//
//        $validator
//                ->date('issue_date')
//                ->allowEmpty('issue_date');
//
//        $validator
//                ->date('start_date')
//                ->allowEmpty('start_date');
//
//        $validator
//                ->scalar('school')
//                ->allowEmpty('school');
//
//        $validator
//                ->scalar('position_no')
//                ->allowEmpty('position_no');
//
//        $validator
//                ->scalar('position_name')
//                ->allowEmpty('position_name');
//
//        $validator
//                ->scalar('position_level')
//                ->allowEmpty('position_level');
//
//        $validator
//                ->scalar('phone_no')
//                ->allowEmpty('phone_no');
//
//        $validator
//                ->scalar('father_name_prefix')
//                ->allowEmpty('father_name_prefix');
//
//        $validator
//                ->scalar('father_first_name')
//                ->allowEmpty('father_first_name');
//
//        $validator
//                ->scalar('father_last_name')
//                ->allowEmpty('father_last_name');
//
//        $validator
//                ->scalar('mother_name_prefix')
//                ->allowEmpty('mother_name_prefix');
//
//        $validator
//                ->scalar('mother_first_name')
//                ->allowEmpty('mother_first_name');
//
//        $validator
//                ->scalar('mother_last_name')
//                ->allowEmpty('mother_last_name');
//
//        $validator
//                ->scalar('spouse_name_prefix')
//                ->allowEmpty('spouse_name_prefix');
//
//        $validator
//                ->scalar('spouse_first_name')
//                ->allowEmpty('spouse_first_name');
//
//        $validator
//                ->scalar('spouse_last_name')
//                ->allowEmpty('spouse_last_name');

        return $validator;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName() {
        return 'master';
    }

}
