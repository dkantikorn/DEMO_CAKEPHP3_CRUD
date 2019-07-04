<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityLogs Model
 *
 * @method \App\Model\Entity\ActivityLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActivityLogsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('activity_logs');
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

//        $validator
//            ->scalar('log_level')
//            ->allowEmpty('log_level');
//
//        $validator
//            ->scalar('log_cat')
//            ->allowEmpty('log_cat');
//
//        $validator
//            ->scalar('log_desc')
//            ->allowEmpty('log_desc');
//
//        $validator
//            ->scalar('log_val')
//            ->allowEmpty('log_val');

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

    /**
     * 
     * @param type $logCategory
     * @param type $logDescription
     * @param type $logValue
     * @param type $logLevel
     * @return type
     */
    private function insertLog($logCategory, $logDescription, $logValue = null, $logLevel = "info") {
        $sql = "INSERT INTO activity_logs(log_level,log_cat,log_desc,log_val,created,modified) VALUES('{$logLevel}','{$logCategory}','{$logDescription}','{$logValue}',NOW(),NOW());";
        return $this->getConnection()->query($sql);
    }

    /**
     * 
     * @param type $logCategory
     * @param type $logDescription
     * @return type
     */
    public function logDebug($logCategory, $logDescription) {
        return $this->insertLog($logCategory, $logDescription, null, 'debug');
    }

    /**
     * 
     * @param type $logCategory
     * @param type $logDescription
     * @return type
     */
    public function logInfo($logCategory, $logDescription, $logValue = null) {
        return $this->insertLog($logCategory, $logDescription, $logValue, 'info');
    }

    /**
     * 
     * @param type $logCategory
     * @param type $logDescription
     * @param type $logValue
     * @return type
     */
    public function logError($logCategory, $logDescription, $logValue) {
        return $this->insertLog($logCategory, $logDescription, $logValue, 'error');
    }

}
