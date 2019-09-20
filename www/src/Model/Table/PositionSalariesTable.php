<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PositionSalaries Model
 *
 * @method \App\Model\Entity\PositionSalary get($primaryKey, $options = [])
 * @method \App\Model\Entity\PositionSalary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PositionSalary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PositionSalary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PositionSalary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PositionSalary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PositionSalary findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PositionSalariesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('position_salaries');
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
        $validator
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('card_no')
                ->allowEmpty('card_no');

        $validator
                ->scalar('issue_date')
                ->allowEmpty('issue_date');

        $validator
                ->scalar('prev_position')
                ->allowEmpty('prev_position');

        $validator
                ->scalar('position_name')
                ->allowEmpty('position_name');

        $validator
                ->scalar('position_no')
                ->allowEmpty('position_no');

        $validator
                ->scalar('salary')
                ->allowEmpty('salary');

        $validator
                ->scalar('salary_level')
                ->allowEmpty('salary_level');

        $validator
                ->scalar('position_level')
                ->allowEmpty('position_level');

        $validator
                ->scalar('ref_title_name')
                ->allowEmpty('ref_title_name');

        $validator
                ->scalar('ref_command_follow')
                ->allowEmpty('ref_command_follow');

        $validator
                ->scalar('ref_command_no')
                ->allowEmpty('ref_command_no');

        $validator
                ->scalar('ref_command_date')
                ->allowEmpty('ref_command_date');

        $validator
                ->scalar('ref_full')
                ->allowEmpty('ref_full');

        $validator
                ->scalar('order_no')
                ->allowEmpty('order_no');

        $validator
                ->scalar('school')
                ->allowEmpty('school');

        $validator
                ->scalar('acadamic_standing')
                ->allowEmpty('acadamic_standing');

        $validator
                ->scalar('recheck')
                ->allowEmpty('recheck');

        $validator
                ->scalar('source_file')
                ->allowEmpty('source_file');

        $validator
                ->scalar('remark')
                ->allowEmpty('remark');

        $validator
                ->scalar('code')
                ->allowEmpty('code');

        $validator
                ->scalar('edit_remark')
                ->allowEmpty('edit_remark');

        $validator
                ->scalar('other')
                ->allowEmpty('other');

        $validator
                ->scalar('affiliation')
                ->allowEmpty('affiliation');

        $validator
                ->scalar('issue_date_prev')
                ->allowEmpty('issue_date_prev');

        $validator
                ->scalar('ref_command_date_prev')
                ->allowEmpty('ref_command_date_prev');

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
