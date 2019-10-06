<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveRecords Model
 *
 * @method \App\Model\Entity\LeaveRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LeaveRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRecord|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRecord findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeaveRecordsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('leave_records');
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('card_no')
            ->allowEmpty('card_no');

        $validator
            ->scalar('order_no')
            ->allowEmpty('order_no');

        $validator
            ->scalar('issue_year')
            ->allowEmpty('issue_year');

        $validator
            ->scalar('sick_leave')
            ->allowEmpty('sick_leave');

        $validator
            ->scalar('errand_leave')
            ->allowEmpty('errand_leave');

        $validator
            ->scalar('holiday_leave')
            ->allowEmpty('holiday_leave');

        $validator
            ->scalar('maternity_leave')
            ->allowEmpty('maternity_leave');

        $validator
            ->scalar('husband_maternity_leave')
            ->allowEmpty('husband_maternity_leave');

        $validator
            ->scalar('ordination_leave')
            ->allowEmpty('ordination_leave');

        $validator
            ->scalar('military_leave')
            ->allowEmpty('military_leave');

        $validator
            ->scalar('edu_leave')
            ->allowEmpty('edu_leave');

        $validator
            ->scalar('inter_work_leave')
            ->allowEmpty('inter_work_leave');

        $validator
            ->scalar('follow_spouse_leave')
            ->allowEmpty('follow_spouse_leave');

        $validator
            ->scalar('rehabilitation_leave')
            ->allowEmpty('rehabilitation_leave');

        $validator
            ->scalar('recheck')
            ->allowEmpty('recheck');

        $validator
            ->scalar('source_file')
            ->allowEmpty('source_file');

        $validator
            ->scalar('remark')
            ->allowEmpty('remark');

        return $validator;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'master';
    }
}
