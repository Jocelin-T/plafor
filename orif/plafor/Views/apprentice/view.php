<div class="container">
    <!-- Apprentice details -->
    <div class="row">
        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_view_apprentice')?></p>
        </div>
        <div class="col-sm-6">
            <p><span class="font-weight-bold"><?=$apprentice['username']?></span>
            <br><?=$apprentice['email']?></p>
        </div>
        <div class="col-sm-6">
            <p><span class="font-weight-bold"><?=lang('plafor_lang.title_trainer_linked')?></span>

            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_trainer):?>
                <!-- List with ADMIN buttons, accessible for trainers or admin only -->
                </p><table class="table table-hover table-borderless">
                <tbody>
                    <?php
                    foreach ($links as $link):
                        foreach ($trainers as $trainer):
                            if($link['fk_trainer'] == $trainer['id']): ?>
                                <tr>
                                    <td><a href="<?= base_url('plafor/apprentice/list_apprentice/'.$trainer['id']); ?>"><?= $trainer['username']; ?></a></td>
                                    <td><a href="<?= base_url('plafor/apprentice/save_apprentice_link/'.$apprentice['id'].'/'.$link['id']) ?>"><i class="bi-pencil" style="font-size: 20px;"></i></a></td>
                                    <td><a href="<?= base_url('plafor/apprentice/delete_apprentice_link/'.$link['id']) ?>"><i class="bi-trash" style="font-size: 20px;"></i></a></td>
                                </tr>
                            <?php endif;
                        endforeach;
                    endforeach;
                    ?>
                </tbody>
                </table>

                <a class="btn btn-primary text-white" href="<?= base_url('plafor/apprentice/save_apprentice_link/'.$apprentice['id'])?>"><?= lang('plafor_lang.title_apprentice_link_new') ?></a>
            <?php else:?>
                <?php
                foreach ($links as $link):
                    foreach ($trainers as $trainer):
                        if($link['fk_trainer'] == $trainer['id']): ?>
                            <br><?= $trainer['username']; ?>
                        <?php endif;
                    endforeach;
                endforeach;
                ?>
                </p>
            <?php endif ?>
        </div>

        <!-- Linked course plans -->
        <div class="col-12 mt-2">
            <p><span class="font-weight-bold"><?=lang('plafor_lang.title_apprentice_followed_courses')?></span></p>

            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_trainer):?>
                <!-- List with ADMIN buttons, accessible for trainers or admin only -->
                <table class="table table-hover table-borderless">
                <tbody>
                    <?php foreach ($user_courses as $user_course) { ?>
                        <tr>
                            <td><?=$user_course_status[$user_course['fk_status']]['name']?></td>
                            <td><a href="<?= base_url('plafor/apprentice/view_user_course/'.$user_course['id']) ?>"><?=$course_plans[$user_course['fk_course_plan']]['official_name']?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>

                <a class="btn btn-primary text-white" href="<?= base_url('plafor/apprentice/save_user_course/'.$apprentice['id'])?>"><?= lang('plafor_lang.title_user_course_new') ?></a>
            <?php else:?>
                <table class="table table-hover table-borderless">
                <tbody>
                    <?php foreach ($user_courses as $user_course) { ?>
                        <tr>
                            <td><?=$user_course_status[$user_course['fk_status']]['name']?></td>
                            <td><a href="<?= base_url('plafor/apprentice/view_user_course/'.$user_course['id']) ?>"><?=$course_plans[$user_course['fk_course_plan']]['official_name']?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
    
    <!-- Current course plan detailed status -->
    <div class="row mt-2">
        <?php 
            $maxdate=null;
            $userCourseMax=null;
            foreach ($user_courses as $user_course){
                if($maxdate==null){
                    $maxdate=$user_course['date_begin'];
                    $userCourseMax=$user_course;
                }
                if(strtotime($user_course['date_begin'])>strtotime($maxdate)){
                    $maxdate=$user_course['date_begin'];
                    $userCourseMax=$user_course;
                }
            }
        ?>

        <div class="col-md-12">
            <p class="bg-primary text-white"><?=lang('plafor_lang.title_course_plan_status')?></p>
            <p class="font-weight-bold"><?= $course_plans[$userCourseMax['fk_course_plan']]['official_name'] ?></p>
            <div id="detailsArray" apprentice_id="<?= $apprentice['id'] ?>" course_plan_id="<?=$userCourseMax['fk_course_plan']?>"></div>
        </div>
    </div>
</div>

<script type="text/babel">
    $(document).ready(()=>{
            displayDetails(null,<?=json_encode($userCourseMax)?>,'integrated');
    })
</script>