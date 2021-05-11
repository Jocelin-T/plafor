<?php 

namespace Plafor\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use User\Models\User_model;

class CommentModel extends Model{
    private static $commentModel=null;
    protected $table='comment';
    protected $primaryKey='id';
    protected $allowedFields=['fk_trainer','fk_acquisition_status','comment','date_creation'];
    private $acquisitionStatusModel=null;

    /**
     * @return CommentModel
     */
    public static function getInstance(){
        if (CommentModel::$commentModel==null)
            CommentModel::$commentModel=new CommentModel();
        return CommentModel::$commentModel;
    }

    /**
     * @param $fkTrainerId /the id of fk_trainer
     * @return array|null
     */
    public static function getTrainer($fkTrainerId){
        return (new User_model())->find($fkTrainerId);
    }

    /**
     * @param $fkAcquisitionStatusId
     * @return array|null
     */
    public static function getAcquisitionStatus($fkAcquisitionStatusId){
        return AcquisitionStatusModel::getInstance()->find($fkAcquisitionStatusId);
    }
}






?>