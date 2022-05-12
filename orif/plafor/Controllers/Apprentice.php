<?php


namespace Plafor\Controllers;


use CodeIgniter\Config\Services;
use CodeIgniter\I18n\Time;
use CodeIgniter\Validation\Validation;
use Exception;
use Plafor\Models\AcquisitionLevelModel;
use Plafor\Models\AcquisitionStatusModel;
use Plafor\Models\CommentModel;
use Plafor\Models\CompetenceDomainModel;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\CoursePlanModuleModel;
use Plafor\Models\ModuleModel;
use Plafor\Models\ObjectiveModel;
use Plafor\Models\OperationalCompetenceModel;
use Plafor\Models\UserCourseModel;
use Plafor\Models\UserCourseStatusModel;
use Plafor\Models\TrainerApprenticeModel;
use Plafor\Models\UserCourseModuleGradeModel;
use User\Models\User_type_model;
use User\Models\User_model;

class Apprentice extends \App\Controllers\BaseController
{
    private Validation $validation;
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        $this->access_level=config('\User\Config\UserConfig')->access_level_apprentice;
        parent::initController($request, $response, $logger);
        $this->validation=Services::validation();
    }

    /**
     * Default method, redirect to a homepage depending on the type of user
     */
    public function index() {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            // Session is set, redirect depending on the type of user
            if($_SESSION['user_access'] >= config('\User\Config\UserConfig')->access_lvl_admin) {
                // User is administrator
                return redirect()->to(base_url('user/admin/list_user'));
            } elseif ($_SESSION['user_access'] >= config('\User\Config\UserConfig')->access_lvl_trainer) {
                // User is trainer
                return redirect()->to(base_url('plafor/apprentice/list_apprentice?trainer_id='.$_SESSION['user_id']));
            } else {
                // User is apprentice
                return redirect()->to(base_url('plafor/apprentice/view_apprentice/'.$_SESSION['user_id']));
            }
        } else {
            // No session is set, redirect to login page
            return redirect()->to(base_url('user/auth/login'));
        }
    }


    public function list_apprentice($withDeleted=0)
    {
        $trainer_id = $this->request->getGet('trainer_id');
        if ($trainer_id==null && $this->session->get('user_access')==config('\User\Config\UserConfig')->access_lvl_trainer){
            $trainer_id=$this->session->get('user_id');
        }
        $trainersList = array();
        $trainersList[0] = lang('common_lang.all_m');
        $apprentice_level = User_type_model::getInstance()->where('access_level', config("\User\Config\UserConfig")->access_level_apprentice)->find();

        foreach(User_model::getTrainers() as $trainer)
            {
                $trainersList[$trainer['id']] = $trainer['username'];
            }

        if($trainer_id == null or $trainer_id == 0){
            $apprentices = User_model::getApprentices($withDeleted);

            $coursesList=[];
            foreach (CoursePlanModel::getInstance()->findall() as $courseplan)
                $coursesList[$courseplan['id']]=$courseplan;
            $courses = UserCourseModel::getInstance()->findall();
        }else{
                $apprentices = User_Model::getInstance()->whereIn('id', array_column(TrainerApprenticeModel::getInstance()->where('fk_trainer', $trainer_id)->findall(), 'fk_apprentice'))->findall();
                $coursesList=[];
                foreach (CoursePlanModel::getInstance()->findall() as $courseplan)
                    $coursesList[$courseplan['id']]=$courseplan;
                $courses = UserCourseModel::getInstance()->findall();
            }


        $output = array(
            'title' => lang('plafor_lang.title_list_apprentice'),
            'trainer_id' => $trainer_id,
            'trainers' => $trainersList,
            'apprentices' => $apprentices,
            'coursesList' => $coursesList,
            'courses' => $courses,
            'with_archived' => $withDeleted
        );

        $this->display_view(['Plafor\apprentice/list'], $output);
    }

    public function view_apprentice($apprentice_id = null)
    {
        $apprentice = User_model::getInstance()->find($apprentice_id);

        if(is_null($apprentice) || $apprentice['fk_user_type'] != User_type_model::getInstance()->where('name',lang('plafor_lang.title_apprentice'))->first()['id']){
            return redirect()->to(base_url("/plafor/apprentice/list_apprentice"));
        }
        $user_courses=[];
        foreach (UserCourseModel::getInstance()->where('fk_user',$apprentice_id)->findall() as $usercourse) {
            $date_begin = Time::createFromFormat('Y-m-d', $usercourse['date_begin']);
            $date_end = Time::createFromFormat('Y-m-d', $usercourse['date_end']);
            $usercourse['date_begin'] = $date_begin->toLocalizedString('dd.MM.Y');
            $usercourse['date_end']!=='0000-00-00'? $usercourse['date_end'] = $date_end->toLocalizedString('dd.MM.Y'):null;
            $user_courses[$usercourse['id']] = $usercourse;
        }

        $user_course_status=[];
        foreach (UserCourseStatusModel::getInstance()->findAll() as $usercoursetatus)
        $user_course_status[$usercoursetatus['id']] = $usercoursetatus;

        $course_plans=[];
        foreach (CoursePlanModel::getInstance()->findall() as $courseplan)
        $course_plans[$courseplan['id']] = $courseplan;

        $trainers = [];
        foreach (User_model::getInstance()->where('fk_user_type',User_type_model::getInstance()->where('name',lang('plafor_lang.title_trainer'))->first()['id'])->findall() as $trainer)
            $trainers[$trainer['id']]= $trainer;

        $links = [];
        foreach (TrainerApprenticeModel::getInstance()->where('fk_apprentice',$apprentice_id)->findAll() as $link)
            $links[$link['id']]=$link;

        $output = array(
            'title' => lang('plafor_lang.title_view_apprentice'),
            'apprentice' => $apprentice,
            'trainers' => $trainers,
            'links' => $links,
            'user_courses' => $user_courses,
            'user_course_status' => $user_course_status,
            'course_plans' => $course_plans
        );
        $this->display_view('Plafor\apprentice/view',$output);
    }

    /**
     * Form to create a link between a apprentice and a course plan
     *
     * @param int (SQL PRIMARY KEY) $id_user_course
     */
    public function save_user_course($id_apprentice = null,$id_user_course = 0){
        if ($this->session->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_trainer) {
            $apprentice = User_model::getInstance()->find($id_apprentice);
            $user_course = UserCourseModel::getInstance()->find($id_user_course);

            if ($id_apprentice == null || $apprentice['fk_user_type'] != User_type_model::getInstance()->where('name', lang('plafor_lang.title_apprentice'))->first()['id']) {
                return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
                exit();
            }

            if (count($_POST) > 0) {
                $fk_course_plan = $this->request->getPost('course_plan');
                $user_course = array(
                    'fk_user' => $id_apprentice,
                    'fk_course_plan' => $fk_course_plan,
                    'fk_status' => $this->request->getPost('status'),
                    'date_begin' => $this->request->getPost('date_begin'),
                    'date_end' => $this->request->getPost('date_end'),
                );
                if ($id_user_course > 0) {
                    //update
                    UserCourseModel::getInstance()->update($id_user_course, $user_course);
                } else if (UserCourseModel::getInstance()->where('fk_user', $id_apprentice)->where('fk_course_plan', $fk_course_plan)->first() == null) {
                    //insert
                    $id_user_course = UserCourseModel::getInstance()->insert($user_course);

                    $course_plan = UserCourseModel::getCoursePlan($user_course['fk_course_plan']);
                    $competenceDomainIds = [];

                    foreach (CoursePlanModel::getCompetenceDomains($course_plan['id']) as $competence_domain) {
                        $competenceDomainIds[] = $competence_domain['id'];
                    }

                    $operational_competences = [];
                    // si il n'y a pas de compétence operationnelles associées
                    try {
                        $operational_competences = OperationalCompetenceModel::getInstance()->withDeleted()->whereIn('fk_competence_domain', $competenceDomainIds)->findAll();
                    } catch (\Exception $e) {
                    };
                    $objectiveIds = array();
                    foreach ($operational_competences as $operational_competence) {
                        foreach (OperationalCompetenceModel::getObjectives($operational_competence['id']) as $objective) {
                            $objectiveIds[] = $objective['id'];
                        }
                    }
                    foreach ($objectiveIds as $objectiveId) {
                        $acquisition_status = array(
                            'fk_objective' => $objectiveId,
                            'fk_user_course' => $id_user_course,
                            'fk_acquisition_level' => 1
                        );

                        AcquisitionStatusModel::getInstance()->insert($acquisition_status);
                    }
                }
                if (UserCourseModel::getInstance()->errors() == null) {
                    //if ok
                    return redirect()->to(base_url('plafor/apprentice/view_apprentice/' . $id_apprentice));
                    exit();
                }
            }
            $course_plans = [];
            foreach (CoursePlanModel::getInstance()->findAll() as $courseplan)
                $course_plans[$courseplan['id']] = $courseplan['official_name'];
            $status = [];
            foreach (UserCourseStatusModel::getInstance()->findAll() as $usercoursestatus) {
                $status[$usercoursestatus['id']] = $usercoursestatus['name'];
            }
            $output = array(
                'title' => lang('plafor_lang.title_user_course_plan_link'),
                'course_plans' => $course_plans,
                'user_course' => $user_course,
                'status' => $status,
                'apprentice' => $apprentice,
                'errors' => UserCourseModel::getInstance()->errors()
            );

            return $this->display_view('Plafor\user_course/save', $output);
        }
        else{
            return $this->display_view('\User\errors\403error');
        }
    }
    /**@todo the user doesn't modify the trainer but add one on update
    /**
     * Create a link between a apprentice and a trainer, or change the trainer
     * linked on the selected trainer_apprentice SQL entry
     *
     * @param int $id_apprentice = ID of the apprentice to add the link to or change the link of
     * @param int $id_link = ID of the link to modify. If 0, adds a new link
     * @return void
     */
    public function save_apprentice_link($id_apprentice = null, $id_link = null){

        $apprentice = User_model::getInstance()->find($id_apprentice);

        if($_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_trainer
            || $apprentice == null
            || $apprentice['fk_user_type'] != User_type_model::getInstance()->
            where('name',lang('plafor_lang.title_apprentice'))->first()['id']){
            return redirect()->to(base_url());
        }

        if(count($_POST) > 0){
            $apprentice_link = array(
                'fk_trainer' => $this->request->getPost('trainer'),
                'fk_apprentice' => $this->request->getPost('apprentice'),
            );
            $old_link = TrainerApprenticeModel::getInstance()->where('fk_trainer',$apprentice_link['fk_trainer'])->where('fk_apprentice',$apprentice_link['fk_apprentice'])->first();
            if ($id_link != null) {
                if (!is_null($old_link)) {
                    // Delete the old link instead of deleting the one being changed
                    // It's easier that way
                    TrainerApprenticeModel::getInstance()->delete($id_link);
                } else {
                    TrainerApprenticeModel::getInstance()->update($id_link,$apprentice_link);
                }
            } elseif (is_null($old_link)) {
                // Don't insert a new link that is the same as an old one
                TrainerApprenticeModel::getInstance()->insert($apprentice_link);
            }

            if(TrainerApprenticeModel::getInstance()->errors()==null){
                //ok
                // This is used to prevent an apprentice from being linked to the same person twice
                return redirect()->to(base_url("plafor/apprentice/view_apprentice/{$id_apprentice}"));
            }
        }
        // It seems that the MY_model dropdown method can't return a filtered result
        // so here we get every users that are trainer, then we create a array
        // with the matching constitution

        $trainersRaw = User_model::getTrainers();

        $trainers = array();

        foreach ($trainersRaw as $trainer){
            $trainers[$trainer['id']] = $trainer['username'];
        }

        $link = $id_link==null?null:TrainerApprenticeModel::getInstance()->find($id_link);

        $output = array(
            'title'=>lang('plafor_lang.title_save_apprentice_link'),
            'apprentice' => $apprentice,
            'trainers' => $trainers,
            'link' => $link,
            'errors'=>TrainerApprenticeModel::getInstance()->errors()
        );

        $this->display_view('Plafor\apprentice/link',$output);
    }
    /**
     * Deletes a trainer_apprentice link depending on $action
     *
     * @param integer $link_id = ID of the trainer_apprentice_link to affect
     * @param integer $action = Action to apply on the trainer_apprentice link :
     *  - 0 for displaying the confirmation
     *  - 1 for deleting (hard delete)
     * @return void
     */
    public function delete_apprentice_link($link_id, $action = 0)
    {

        if ($_SESSION['user_access'] >= config('\User\Config\UserConfig')->access_lvl_trainer) {
            $link = TrainerApprenticeModel::getInstance()->find($link_id);
            $apprentice = TrainerApprenticeModel::getApprentice($link['fk_apprentice']);
            $trainer = TrainerApprenticeModel::getTrainer($link['fk_trainer']);
            if (is_null($link)) {
                return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
            }

            switch ($action) {
                case 0: // Display confirmation
                    $output = array(
                        'link' => $link,
                        'apprentice' => $apprentice,
                        'trainer' => $trainer,
                        'title' => lang('plafor_lang.title_apprentice_link_delete')
                    );
                    $this->display_view('\Plafor\apprentice/delete', $output);
                    break;
                case 1: // Delete apprentice link
                    TrainerApprenticeModel::getInstance()->delete($link_id, TRUE);
                    return redirect()->to(base_url('plafor/apprentice/list_apprentice/' . $apprentice['id']));
                default: // Do nothing
                    return redirect()->to(base_url('plafor/apprentice/list_apprentice/' . $apprentice['id']));
            }
        }
        else{
            return $this->display_view('\User\errors\403error');
        }
    }
    /**
     * Show details of the selected acquisition status
     *
     * @param int $acquisition_status_id = ID of the acquisition status to view
     * @return void
     */
    public function view_acquisition_status($acquisition_status_id = null){
        $acquisition_status = AcquisitionStatusModel::getInstance()->find($acquisition_status_id);
        $objective=AcquisitionStatusModel::getObjective($acquisition_status['fk_objective']);
        $acquisition_level=AcquisitionStatusModel::getAcquisitionLevel($acquisition_status['fk_acquisition_level']);
        if($acquisition_status == null){
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }

        $comments = CommentModel::getInstance()->where('fk_acquisition_status',$acquisition_status_id)->findAll();
        $trainers = User_model::getTrainers();
        $output = array(
            'title' => lang('plafor_lang.title_acquisition_status_view'),
            'acquisition_status' => $acquisition_status,
            'trainers' => $trainers,
            'comments' => $comments,
            'objective' => $objective,
            'acquisition_level' => $acquisition_level,
        );

        return $this->display_view('Plafor\acquisition_status/view',$output);
    }
    /**
     * Changes an acquisition status for an apprentice
     *
     * @param int $acquisition_status_id = ID of the acquisition status to change
     * @return void
     */
    public function save_acquisition_status($acquisition_status_id = 0) {
        $acquisitionStatus = AcquisitionStatusModel::getInstance()->find($acquisition_status_id);

        if($_SESSION['user_access'] == config('\User\Config\UserConfig')->access_level_apprentice) {
            // No need to check with $user_course outside of an apprentice
            $userCourse = UserCourseModel::getInstance()->find($acquisitionStatus['fk_user_course']);
            if ($userCourse['fk_user'] != $_SESSION['user_id']) {
                return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
            }
        }

        if (is_null($acquisitionStatus)) {
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }
        $acquisitionLevels=[];
        foreach (AcquisitionLevelModel::getInstance()->findAll() as $acquisitionLevel)
            $acquisitionLevels[$acquisitionLevel['id']]=$acquisitionLevel['name'];

        // Check if data was sent
        if (!empty($_POST)) {
            $acquisitionLevel = $this->request->getPost('field_acquisition_level');
            $acquisitionStatus = [
                'fk_acquisition_level' => $acquisitionLevel
            ];
            AcquisitionStatusModel::getInstance()->update($acquisition_status_id, $acquisitionStatus);


            if (AcquisitionStatusModel::getInstance()->errors()==null) {

                //if ok
                return $this->response->setStatusCode(200,'OK');
            }
        }

        $output = [
            'title'=>lang('plafor_lang.title_acquisition_status_save'),
            'acquisition_levels' => $acquisitionLevels,
            'acquisition_level' => $acquisitionStatus['fk_acquisition_level'],
            'id' => $acquisition_status_id,
            'errors'=> AcquisitionStatusModel::getInstance()->errors()
        ];

        return $this->display_view('Plafor\acquisition_status/save', $output);
    }
    public function add_comment($acquisition_status_id = null, $comment_id = null){
        $acquisition_status = AcquisitionStatusModel::getInstance()->find($acquisition_status_id);

        if($acquisition_status == null || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_trainer){
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }

        if (count($_POST) > 0) {
            $comment = array(
                'fk_trainer' => $_SESSION['user_id'],
                'fk_acquisition_status' => $acquisition_status_id,
                'comment' => $this->request->getPost('comment'),
                'date_creation' => date('Y-m-d H:i:s'),
            );
            if($comment_id == null)
                CommentModel::getInstance()->insert($comment);
            else
                CommentModel::getInstance()->update($comment_id, $comment);

            if (CommentModel::getInstance()->errors()==null) {
                //if ok

                return redirect()->to(base_url('plafor/courseplan/view_acquisition_status/'.$acquisition_status['id']));
            }

        }

        $comment = CommentModel::getInstance()->find($comment_id);

        $output = array(
            'title'=>lang('plafor_lang.title_comment_save'),
            'acquisition_status' => $acquisition_status,
            'comment_id' => $comment_id,
            'commentValue' => ($comment['comment']??''),
            'errors'    => CommentModel::getInstance()->errors()
        );

        return $this->display_view('\Plafor\comment/save',$output);
    }

    public function delete_comment($comment_id = 0, $acquisition_status_id = 0) {
        CommentModel::getInstance()->delete($comment_id);
        return redirect()->to(base_url('plafor/courseplan/view_acquisition_status/'.$acquisition_status_id));
    }



    /**
     * @param null $userId the id of user
     * If admin
     */
    public function getCoursePlanProgress($userId=null,$coursePlanId=null){
        if ($userId==null && $this->session->get('user_id')==null)
            return;
        //if user is admin
        if($this->session->get('user_access')>=config('\User\UserConfig')->access_lvl_admin){
            return $this->response->setContentType('application/json')->setBody(json_encode($coursePlanId!=null?[(CoursePlanModel::getInstance()->getCoursePlanProgress($userId))[$coursePlanId]]:CoursePlanModel::getInstance()->getCoursePlanProgress($userId),JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
        //in the case of a trainer see only his apprentices
        elseif ($this->session->get('user_access')>=config('\User\UserConfig')->access_lvl_trainer&&in_array($userId,TrainerApprenticeModel::getApprenticeIdsFromTrainer($this->session->get('user_id')))){
            return $this->response->setContentType('application/json')->setBody(json_encode($coursePlanId!=null?[(CoursePlanModel::getInstance()->getCoursePlanProgress($userId))[$coursePlanId]]:CoursePlanModel::getInstance()->getCoursePlanProgress($userId),JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        }
        else{
            $response=null;
            //In the case of a student let him only see his coursePlanProgress else return 403
            $userId!=$this->session->get('user_id')?$response=$this->response->setStatusCode(403):$response=$this->response->setContentType('application/json')->setBody(json_encode($coursePlanId!=null?[(CoursePlanModel::getInstance()->getCoursePlanProgress($userId))[$coursePlanId]]:CoursePlanModel::getInstance()->getCoursePlanProgress($userId),JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

            return $response;
        }



    }
    /**
     * Show a user course's details
     *
     * @param int $id_user_course = ID of the user course to view
     * @return void
     */
    public function view_user_course($id_user_course = null){
        $objectives = null;
        $acquisition_levels = null;
        $user_course = UserCourseModel::getInstance()->find($id_user_course);
        if($user_course == null){
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }

        $apprentice = User_model::getInstance()->find($user_course['fk_user']);
        if($_SESSION['user_access'] == config('\User\Config\UserConfig')->access_level_apprentice && $apprentice['id'] != $_SESSION['user_id']) {
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }
        $user_course_status = UserCourseModel::getUserCourseStatus($user_course['fk_status']);
        $course_plan = UserCourseModel::getCoursePlan($user_course['fk_course_plan']);
        $trainers_apprentice = TrainerApprenticeModel::getInstance()->where('fk_apprentice',$apprentice['id'])->findAll();
        if($user_course == null){
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }
        //if url parameters contains filter operationalCompetenceId
        if ($this->request->getGet('operationalCompetenceId')!=null){
            $objectives=[];
            $acquisition_status=[];
            foreach(CoursePlanModel::getCompetenceDomains(UserCourseModel::getInstance()->find($id_user_course)['fk_course_plan'])as $competenceDomain) {
                foreach (CompetenceDomainModel::getOperationalCompetences($competenceDomain['id']) as $operationalCompetence) {
                    if ($operationalCompetence['id'] == $this->request->getGet('operationalCompetenceId')) {
                        foreach (OperationalCompetenceModel::getObjectives($operationalCompetence['id']) as $objective){
                            $objectives[$objective['id']]=$objective;
                        }
                    }
                }
            }
            foreach (UserCourseModel::getAcquisitionStatus($id_user_course) as $acquisition_statuse){
                foreach ($objectives as $objective){
                    if ($acquisition_statuse['fk_objective'] ==$objective['id']){
                        $acquisition_status[]=$acquisition_statuse;
                    }
                }
            }
        }
        else {
            $acquisition_status = UserCourseModel::getAcquisitionStatus($id_user_course);

            foreach ($acquisition_status as $acquisitionstatus) {
                $objectives[$acquisitionstatus['fk_objective']] = AcquisitionStatusModel::getObjective($acquisitionstatus['fk_objective']);
            }
        }
        foreach (AcquisitionLevelModel::getInstance()->findAll() as $acquisitionLevel) {
            $acquisition_levels[$acquisitionLevel['id']] = $acquisitionLevel;
        }
        $output = array(
            'title'=>lang('plafor_lang.title_user_course_view'),
            'user_course' => $user_course,
            'apprentice' => $apprentice,
            'user_course_status' => $user_course_status,
            'course_plan' => $course_plan,
            'trainers_apprentice' => $trainers_apprentice,
            'acquisition_status' => $acquisition_status,
            'acquisition_levels' => $acquisition_levels,
            'objectives'=>$objectives
        );

        $this->display_view('\Plafor\user_course/view',$output);
    }

    /**
     * Lists the modules of an apprentice
     *
     * @param  integer $apprentice_id ID of the apprentice whose modules are to show.
     * If the current user is an apprentice, it is ignored.
     * @param  boolean $with_archived If true, shows the archived grades too.
     * @return void
     */
    public function list_grades(int $apprentice_id = 0, bool $with_archived = false)
    {
        if (!isset($_SESSION['user_access'])) {
            return $this->display_view('\User\errors\403error');
        }

        // Check that the current user has access to the apprentice
        /** @var \Config\UserConfig */
        $config = config('\User\Config\UserConfig');
        $user_access = $_SESSION['user_access'];

        if ($user_access == $config->access_level_apprentice) {
            // Ignore parameter apprentice id
            $apprentice_id = (int)$_SESSION['user_id'];
        } elseif ($user_access == $config->access_lvl_trainer) {
            // Only allow own apprentices
            $apprentices_ids = TrainerApprenticeModel::getInstance()->where('fk_trainer', $_SESSION['user_id'])->findColumn('fk_apprentice');
            if (is_null($apprentices_ids) || !in_array($apprentice_id, $apprentices_ids)) {
                return redirect()->to(base_url('plafor/apprentice/list_apprentice?trainer_id=' . $_SESSION['user_id']));
            }
        } // Else it's an admin with full rights

        $apprentice = User_model::getInstance()->find($apprentice_id);
        if (
            is_null($apprentice) ||
            User_type_model::getInstance()->find($apprentice['fk_user_type'])['access_level'] != $config->access_level_apprentice
        ) {
            // Not an apprentice
            return redirect()->to(base_url('/plafor/apprentice/list_apprentice'));
        }

        $user_course_plans = UserCourseModel::getInstance()->where('fk_user', $apprentice_id)->where('fk_status', 1)->findAll();
        // All modules of a course plan. The key is the course plan's id
        $courses_modules = [];
        // All grades of a course plan. The structure is [<course_plan_id> => [<module_id> => [<grades>]]]
        $courses_grades = [];
        // The grades' average of a course plan. The structure is [<course_plan_id> => [<module_id> => <average>]]
        $courses_averages = [];
        $course_plans = [];
        if (!empty($user_course_plans)) {
            foreach ($user_course_plans as $user_course) {
                $course_plans[$user_course['id']] = CoursePlanModel::getInstance()->find($user_course['fk_course_plan']);
            }
        }

        foreach ($user_course_plans as $user_course) {
            $course_plan_id = $user_course['fk_course_plan'];

            $course_modules = [];
            $course_grades = [];
            $course_averages = [];

            $links = CoursePlanModuleModel::getInstance()->where('fk_course_plan', $course_plan_id)->findAll() ?? [];
            foreach ($links as $link) {
                $module_id = $link['fk_module'];
                $module = ModuleModel::getInstance()->find($module_id);
                $module['is_school'] = $link['is_school'];
                $course_modules[$module_id] = $module;

                $course_grades[$module_id] = UserCourseModuleGradeModel::getInstance()->withDeleted($with_archived)->where('fk_user_course', $user_course['id'])->where('fk_module', $module_id)->findAll() ?? [];
                $grades = UserCourseModuleGradeModel::getInstance()->where('fk_user_course', $user_course['id'])->where('fk_module', $module_id)->findAll() ?? [];
                if (count($grades) > 0) {
                    $course_averages[$module_id] = array_reduce($grades, function($sum, $grade) {
                        return $grade['grade'] + $sum;
                    }) / count($grades);
                }
            }

            if (count($course_averages) > 0) {
                // School modules averages are worth 80% of the course plan average
                $sum_school = 0;
                $count_school = 0;
                // Out of school modules are worth 20% of the course plan average
                $sum_not_school = 0;
                $count_not_school = 0;
                foreach ($course_averages as $module_id => $average) {
                    $module = $course_modules[$module_id];
                    if (empty($module)) continue;

                    if ($module['is_school']) {
                        $sum_school += $average;
                        $count_school++;
                    } else {
                        $sum_not_school += $average;
                        $count_not_school++;
                    }
                }

                if ($count_school > 0 && $count_not_school > 0) {
                    $course_averages['average'] = $sum_school / $count_school * .8 + $sum_not_school / $count_not_school * .2;
                } elseif ($count_school > 0) {
                    $course_averages['average'] = $sum_school / $count_school;
                } elseif ($count_not_school > 0) {
                    $course_averages['average'] = $sum_not_school / $count_not_school;
                }
            }

            $courses_modules[$course_plan_id] = $course_modules;
            $courses_grades[$course_plan_id] = $course_grades;
            $courses_averages[$course_plan_id] = $course_averages;
        }

        $data = [
            'title' => lang('plafor_lang.title_grade_list'),
            'course_plans' => $course_plans,
            'modules' => $courses_modules,
            'grades' => $courses_grades,
            'apprentice' => $apprentice,
            'with_archived' => $with_archived,
            'averages' => $courses_averages,
        ];

        $this->display_view('\Plafor\grade\list', $data);
    }
    /**
     * Adds a grade to an user course for a module
     *
     * @param  integer $user_course_id ID of the user course to add the grade to, can be overridden by POST parameters.
     * @param  integer $module_id ID of the module the grade is for, can be overridden by POST parameters.
     * @return void
     */
    public function add_grade(int $user_course_id = 0, int $module_id = 0)
    {
        if (!isset($_SESSION['user_access'])) {
            return $this->display_view('\User\errors\403error');
        }

        // Get POST data
        if (!empty($id = $this->request->getPost('user_course_id'))) {
            $user_course_id = $id;
        }
        if (!empty($id = $this->request->getPost('module_id'))) {
            $module_id = $id;
        }

        // Check that the user course, the module, and a link between them exist
        $user_course = UserCourseModel::getInstance()->find($user_course_id);
        if (empty($user_course) || empty(ModuleModel::getInstance()->find($module_id)) ||
            empty(CoursePlanModuleModel::getInstance()->where('fk_course_plan', $user_course['fk_course_plan'])->where('fk_module', $module_id)->find())) {
            return $this->index();
        }

        // Check that the current user has access to the apprentice
        $apprentice_id = $user_course['fk_user'];

        /** @var \Config\UserConfig */
        $config = config('\User\Config\UserConfig');
        $user_access = $_SESSION['user_access'];

        if ($user_access == $config->access_level_apprentice && $_SESSION['user_id'] != $apprentice_id) {
            return redirect()->to(base_url('plafor/apprentice/view_apprentice/'.$_SESSION['user_id']));
        } elseif ($user_access == $config->access_lvl_trainer) {
            // Only allow own apprentices
            $apprentices_ids = TrainerApprenticeModel::getInstance()->where('fk_trainer', $_SESSION['user_id'])->findColumn('fk_apprentice');
            if (!in_array($apprentice_id, $apprentices_ids)) {
                return redirect()->to(base_url('plafor/apprentice/list_apprentice?trainer_id=' . $_SESSION['user_id']));
            }
        } // Else it's an admin with full rights

        if (
            is_null($apprentice = User_model::getInstance()->find($apprentice_id)) ||
            User_type_model::getInstance()->find($apprentice['fk_user_type'])['access_level'] != $config->access_level_apprentice
        ) {
            // Not an apprentice
            return redirect()->to(base_url('/plafor/apprentice/list_apprentice'));
        }

        $postData = [];

        if (count($_POST) > 0) {
            $grade = [
                'fk_user_course' => $user_course_id,
                'fk_module' => $module_id,
                'grade' => $this->request->getPost('grade'),
                'date_exam' => $this->request->getPost('date_exam'),
            ];

            UserCourseModuleGradeModel::getInstance()->insert($grade);

            if (UserCourseModuleGradeModel::getInstance()->errors() == null) {
                return redirect()->to(base_url('plafor/apprentice/list_grades/' . $apprentice_id));
            }

            $postData = [
                'fk_user_course' => $user_course_id,
                'fk_module' => $module_id,
                'grade' => $this->request->getPost('grade'),
                'date_exam' => $this->request->getPost('date_exam'),
            ];
        }

        $data = [
            'title' => lang('plafor_lang.title_grade_new'),
            'user_course_id' => $user_course_id,
            'module_id' => $module_id,
            'form_url' => base_url('plafor/apprentice/add_grade'),
            'errors' => UserCourseModuleGradeModel::getInstance()->errors(),
            'grade' => $postData,
            'apprentice_id' => $apprentice_id,
        ];

        $this->display_view('\Plafor\grade\save', $data);
    }
    /**
     * Modifies a grade's value, but not its links
     *
     * @param  integer $grade_id ID of the grade to modify
     * @return void
     */
    public function edit_grade(int $grade_id = 0)
    {
        if (!isset($_SESSION['user_access']) || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_trainer) {
            return $this->display_view('\User\errors\403error');
        }

        // Get POST data
        if (!empty($id = $this->request->getPost('grade_id'))) {
            $grade_id = $id;
        }

        // Check that the grade exists
        $grade = UserCourseModuleGradeModel::getInstance()->withDeleted()->find($grade_id);
        if (empty($grade)) {
            return $this->index();
        }

        // Check that the current user has access to the apprentice
        $apprentice_id = UserCourseModel::getInstance()->find($grade['fk_user_course'])['fk_user'];

        /** @var \Config\UserConfig */
        $config = config('\User\Config\UserConfig');
        $user_access = $_SESSION['user_access'];

        if ($user_access == $config->access_lvl_trainer) {
            // Only allow own apprentices
            $apprentices_ids = TrainerApprenticeModel::getInstance()->where('fk_trainer', $_SESSION['user_id'])->findColumn('fk_apprentice');
            if (!in_array($apprentice_id, $apprentices_ids)) {
                return redirect()->to(base_url('plafor/apprentice/list_apprentice?trainer_id=' . $_SESSION['user_id']));
            }
        } // Else it's an admin with full rights

        $postData = [];

        if (count($_POST) > 0) {
            $grade = [
                // Don't change linked module and course
                'grade' => $this->request->getPost('grade'),
                'date_exam' => $this->request->getPost('date_exam'),
            ];

            UserCourseModuleGradeModel::getInstance()->update($grade_id, $grade);

            if (UserCourseModuleGradeModel::getInstance()->errors() == null) {
                return redirect()->to(base_url('plafor/apprentice/list_grades/' . $apprentice_id));
            }

            $postData = [
                'grade' => $this->request->getPost('grade'),
                'date_exam' => $this->request->getPost('date_exam'),
                'id' => $grade_id,
            ];
        }

        $data = [
            'title' => lang('plafor_lang.title_grade_update'),
            'grade_id' => $grade_id,
            'form_url' => base_url('plafor/apprentice/edit_grade'),
            'errors' => UserCourseModuleGradeModel::getInstance()->errors(),
            'grade' => count($postData) > 0 ? $postData : $grade,
            'apprentice_id' => $apprentice_id,
        ];

        $this->display_view('\Plafor\grade\save', $data);
    }
    /**
     * Deletes a grade
     *
     * @param  integer $grade_id ID of the grade to delete
     * @param  integer $action
     * - 0 to show the confirmation UI
     * - 1 to permanently delete the grade
     * - 2 to deactivate the grade
     * - 3 to reactivate the grade
     * @return void
     */
    public function delete_grade(int $grade_id, int $action = 0)
    {
        if (!isset($_SESSION['user_access']) || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_admin) {
            return $this->display_view('\User\errors\403error');
        }

        $grade = UserCourseModuleGradeModel::getInstance()->withDeleted()->find($grade_id);
        if (empty($grade)) {
            return $this->index();
        }

        $apprentice_id = UserCourseModel::getInstance()->find($grade['fk_user_course'])['fk_user'];

        switch ($action) {
            case 0: // Display confirmation
                $module = ModuleModel::getInstance()->find($grade['fk_module']);

                $data = [
                    'grade' => $grade,
                    'module' => $module,
                ];

                return $this->display_view('\Plafor\grade\delete', $data);
            case 1: // Delete grade
                UserCourseModuleGradeModel::getInstance()->delete($grade_id, TRUE);

                return redirect()->to(base_url('plafor/apprentice/list_grades/' . $apprentice_id));
            case 2: // Deactivate grade
                UserCourseModuleGradeModel::getInstance()->delete($grade_id);

                return redirect()->to(base_url('plafor/apprentice/list_grades/' . $apprentice_id));
            case 3: // Reactivate grade
                UserCourseModuleGradeModel::getInstance()->withDeleted()->update($grade_id, ['archive' => NULL]);

                return redirect()->to(base_url('plafor/apprentice/list_grades/' . $apprentice_id));
            default: // Do nothing
                return redirect()->to(base_url('plafor/apprentice/list_grades/' . $apprentice_id));
        }
    }
}
