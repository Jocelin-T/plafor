<?php
/**
 * Fichier de model pour objective
 *
 * @author      Orif (ViDi, HeMa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */

namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class ObjectiveModel extends \CodeIgniter\Model
{
    private static $objectiveModel=null;
    protected $table='objective';
    protected $primaryKey='id';
    protected $allowedFields=['archive','fk_operational_competence','symbol','taxonomy','name'];
    protected $useSoftDeletes=true;
    protected $deletedField='archive';
    private OperationalCompetenceModel $operationalCompetenceModel;
    protected $validationRules;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        $this->validationRules = array(
            'symbol'=>[
                'label' => 'plafor_lang.field_objective_symbol',
                'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->SYMBOL_MAX_LENGTH.']|is_symbol_unique[]',
            ],
            'taxonomy'=>[
                'label' => 'plafor_lang.field_objective_taxonomy',
                'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->TAXONOMY_MAX_VALUE.']',
            ],
            'name'=>[
                'label' => 'plafor_lang.field_objective_name',
                'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->OBJECTIVE_NAME_MAX_LENGTH.']',
            ]
        );
        parent::__construct($db, $validation);
    }

    /**
     * @return ObjectiveModel
     */
    public static function getInstance(){
        if (ObjectiveModel::$objectiveModel==null)
            ObjectiveModel::$objectiveModel=new ObjectiveModel();
        return ObjectiveModel::$objectiveModel;
    }

    /**
     * @param $fkOperationalCompetenceId
     * @return array|object|null
     */
    public static function getOperationalCompetence($fkOperationalCompetenceId){
        return OperationalCompetenceModel::getInstance()->withDeleted(true)->find($fkOperationalCompetenceId);
    }

    /**
     * @param $objectiveId
     * @return array
     */
    public static function getAcquisitionStatus($objectiveId,$userCourseId=null){
        if ($userCourseId!=null){
            return AcquisitionStatusModel::getInstance()->where('fk_objective',$objectiveId)->where('fk_user_course',$userCourseId)->first();
        }
        return AcquisitionStatusModel::getInstance()->where('fk_objective',$objectiveId)->findAll();
    }

    public static function getObjectives($with_archived=false, $operational_competence_id=0) {
        if($operational_competence_id==0) {
            return ObjectiveModel::getInstance()->withDeleted($with_archived)->findAll();
        } else {
            return ObjectiveModel::getInstance()->where('fk_operational_competence', $operational_competence_id)->withDeleted($with_archived)->findAll();
        }
    }
}