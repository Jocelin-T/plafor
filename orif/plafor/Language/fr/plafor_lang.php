<?php
/**
 * Fichier de language pour le module plafor
 * competence_domain avec les nouveaux plans si n'existent pas
 *
 * @author      Orif (ViDi, HeMa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */

return [

    //Errors
    'same_competence_domain'                => 'Le domaine de compétence existe déjà',
    'same_operational_competence'           => 'La compétence opérationnelle existe déjà',
    'same_objective'                        => 'L\'objectif existe déjà',

    // Field labels
    'field_identity' => 'id',
    
    //Usefull Links
    'plafor_module' => 'Module Plafor',

    // User types
    'title_administrator'            => 'Administrateur',
    'title_trainer'                  => 'Formateur',
    'title_apprentice'               => 'Apprenti',

    //Apprentice
    'title_list_apprentice'             => 'Liste des apprentis',
    'title_view_apprentice'             => 'Détail de l\'apprenti',
    'title_save_apprentice_link'        => 'Ajouter un formateur lié',
    'title_save_user_course'            => 'Ajouter une formation liée',
    'title_view_user_course'            => 'Détail de la formation de l\'apprenti',
    'title_trainer_linked'              => 'Formateur(s)',
    'title_apprentice_followed_courses' => 'Formation(s) suivie(s)',
    'title_apprentice_link_delete'      => 'Supprimer un apprenti lié',
    'title_my_apprentices'              => 'Mes apprentis',

    //Course Plan
    'title_list_course_plan'    => 'Liste des plans de formation',
    'title_view_course_plan'    => 'Détail du plan de formation',
    'title_course_plan_new'     => 'Ajouter un plan de formation',
    'title_course_plan_update'  => 'Modifier le plan de formation',
    'title_course_plan_view'    => 'Afficher les détails du plan de formation',

    //Competence Domain
    'title_view_competence_domain'          => 'Détail du domaine de compétence',
    'title_view_competence_domains_linked'  => 'Domaines de compétences liés',
    'title_list_competence_domain'          => 'Liste des domaines de compétence',
    'title_competence_domain_new'           => 'Ajouter un domaine de compétence',
    'title_competence_domain_update'        => 'Modifier un domaine de compétence',
    'title_competence_domain_list'          => 'Liste des domaines de compétence',

    //Operational Competence
    'title_list_operational_competence'         => 'Liste des compétences opérationnelles',
    'title_view_operational_competence'         => 'Détail de la compétence opérationnelle',
    'title_view_operational_competence_linked'  => 'Compétences opérationnelles liées',
    'title_operational_competence_update'       => 'Modifier une compétence opérationnelle',
    'title_operational_competence_new'          => 'Ajouter une compétence opérationnelle',

    //Objectives
    'title_list_objective'      => 'Liste des objectifs',
    'title_view_objective'      => 'Détail de l\'objectif',
    'title_objective_delete'    => 'Supprimer un objectif',
    'title_objective_update'    => 'Modifier un objectif',
    'title_objective_new'       => 'Ajouter un objectif',

    //User course
    'title_user_course_delete'      => 'Supprimer un cours',
    'title_user_course_view'        => 'Détail du cours',
    'title_user_course_plan_link'   => 'Ajouter un cours associé',

    //Acquisition status
    'title_acquisition_status_view' => 'Afficher les détails des status d\'acquisition',
    'title_acquisition_status_save' => 'Ajouter un statut d\'acquisition',
    'title_acquisition_status_edit' => 'Modifier un statut d\'acquisition',
    
    //Comment
    'title_comment_save'    => 'Ajouter un commentaire',
    'comment_delete'        => 'Souhaitez-vous supprimer le commentaire ?',

    // User Course Status
    'title_in_progress'              => 'En cours',
    'title_successful'               => 'Réussi',
    'title_failed'                   => 'Échouée',
    'title_suspended'                => 'Suspendue',
    'title_abandoned'                => 'Abandonnée',

    // Page titles
    'title_apprentice_list'                 => 'Liste des apprentis',
    'title_apprentice_update'               => 'Modifier l\'apprenti',
    'title_apprentice_new'                  => 'Ajouter un apprenti',
    'title_apprentice_delete'               => 'Supprimer un apprenti',
    'title_trainer_list'                    => 'Liste des formateurs',
    'title_trainer_update'                  => 'Modifier le formateur',
    'title_trainer_new'                     => 'Ajouter un formateur',
    'title_trainer_delete'                  => 'Supprimer un formateur',
    'title_course_plan_list'                => 'Liste des plans de formation',
    'title_course_plan_update'              => 'Modifier le plan de formation',
    'title_course_plan_new'                 => 'Ajouter un plan de formation',
    'title_course_plan_delete'              => 'Supprimer le plan de formation',
    'title_course_plan_enable'              => 'Réactiver le plan de formation',
    'title_course_plan_status'              => 'Avancement du plan de formation',
    'title_competence_domain_list'          => 'Liste des domaines de compétence',
    'title_competence_domain_update'        => 'Modifier le domaine de compétence',
    'title_competence_domain_new'           => 'Ajouter un domaine de compétence',
    'title_competence_domain_delete'        => 'Supprimer le domaine de compétence',
    'title_competence_domain_enable'        => 'Réactiver le domaine de compétence',
    'title_operational_competence_list'     => 'Liste des compétences opérationnelles',
    'title_operational_competence_update'   => 'Modifier la compétence opérationnelle',
    'title_operational_competence_new'      => 'Ajouter une compétence opérationnelle',
    'title_operational_competence_delete'   => 'Supprimer la compétence opérationnelle',
    'title_operational_competence_enable'   => 'Réactiver la compétence opérationnelle',
    'title_objective_list'                  => 'Liste des objectifs',
    'title_objective_update'                => 'Modifier l\'objectif',
    'title_objective_new'                   => 'Ajouter un objectif',
    'title_objective_delete'                => 'Supprimer l\'objectif',
    'title_objective_enable'                => 'Réactiver l\'objectif',
    'title_user_course_list'                => 'Liste des formations',
    'title_user_course_update'              => 'Modifer la formation',
    'title_user_course_new'                 => 'Ajouter une formation',
    'title_user_course_delete'              => 'Supprimer la formation',
    'title_apprentice_link_list'            => 'Liste des formateurs',
    'title_apprentice_link_update'          => 'Modifer le formateur',
    'title_apprentice_link_new'             => 'Ajouter un formateur',
    'title_apprentice_link_delete'          => 'Supprimer le formateur',
    'title_view_acquisition_status'         => 'Détail du statut d\'acquisition',
    'title_acquisition_status_list'         => 'Liste des statuts d\'acquisition',
    'title_acquisition_status_update'       => 'Modifer le statut d\'acquisition',
    'title_acquisition_status_new'          => 'Ajouter un statut d\'acquisition',
    'title_acquisition_status_delete'       => 'Supprimer le statut d\'acquisition',
    'title_comment_list'                    => 'Liste des commentaires',
    'title_comment_update'                  => 'Modifier le commentaire',
    'title_comment_new'                     => 'Ajouter un commentaire',
    'title_comment_delete'                  => 'Supprimer le commentaire',
    'title_progress'                        => 'Avancement',

    // Details labels
    'details_apprentice'                => 'Détail de l\'apprenti',
    'details_course_plan'               => 'Détail du plan de formation',
    'details_competence_domain'         => 'Détail du domaine de compétence',
    'details_operational_competence'    => 'Détail de la compétence opérationnelle',
    'details_objective'                 => 'Détail de l\'objectif',
    'details_user_course'               => 'Détail de la formation de l\'apprenti',
    'details_acquisition_status'        => 'Détail du statut d\'acquisition',
    'details_progress'                  => 'Détails',

    // Fields labels
    'field_apprentice_username'                 => 'Nom de l\'apprenti',
    'field_apprentice_date_creation'            => 'Date de création de l\'apprenti',
    'field_followed_courses'                    => 'Formation(s) suivie(s)',
    'field_linked_competence_domains'           => 'Domaines de compétences liés',
    'field_linked_operational_competence'       => 'Compétences opérationnelles liés',
    'field_course_plan_formation_number'        => 'Numéro du plan de formation',
    'field_course_plans_formation_numbers'      => 'Numéros des plans de formations',
    'field_course_plan_official_name'           => 'Nom du plan de formation',
    'field_course_plans_official_names'         => 'Noms des plans de formation',
    'field_course_plan_date_begin'              => 'Date de création du plan de formation',
    'field_course_plans_dates_begin'            => 'Dates de création des plans de formation',
    'field_course_plan_into_effect'             => 'Entré en vigueur le',
    'field_competence_domain_course_plan'       => 'Plan de formation lié au domaine de compétence',
    'field_competence_domain_symbol'            => 'Symbole du domaine de compétence',
    'field_competence_domains_symbols'          => 'Symbole des domaines de compétences',
    'field_competence_domain_name'              => 'Nom du domaine de compétence',
    'field_competence_domains_names'            => 'Noms des domaines de compétences',
    'field_operational_competence_domain'       => 'Domaine de compétence lié à la compétence opérationnelle',
    'field_operational_competence_name'         => 'Nom de la compétence opérationnelle',
    'field_operational_competences_names'       => 'Noms des compétences opérationnelles',
    'field_operational_competence_symbol'       => 'Symbole de la compétence opérationnelle',
    'field_operational_competences_symbols'     => 'Symboles des compétences opérationnelles',
    'field_operational_competence_methodologic' => 'Compétence méthodologique',
    'field_operational_competence_social'       => 'Compétence sociale',
    'field_operational_competence_personal'     => 'Compétence personnelle',
    'field_objective_operational_competence'    => 'Compétence opérationnelle liée à l\'objectif',
    'field_objective_symbol'                    => 'Symbole de l\'objectif',
    'field_objectives_symbols'                  => 'Symbole des objectif',
    'field_objective_taxonomy'                  => 'Taxonomie de l\'objectif',
    'field_objectives_taxonomies'               => 'Taxonomie des objectifs',
    'field_objective_name'                      => 'Nom de l\'objectif',
    'field_objectives_names'                    => 'Nom des objectifs',
    'field_linked_objectives'                   => 'Objectifs liés à la compétence opérationnelle',
    'field_user_course_date_begin'              => 'Date du début de la formation',
    'field_user_course_date_end'                => 'Date de fin de la formation',
    'field_user_course_course_plan'             => 'Formation',
    'field_user_course_status'                  => 'Statut de la formation',
    'field_user_course_objectives_status'       => 'Statuts d\'acquisition des objectifs',
    'field_comment'                             => 'Commentaire',
    'field_comment_creater'                     => 'Créateur du commentaire',
    'field_comment_date_creation'               => 'Date de création du commentaire',
    'field_trainer_link'                        => 'Formateur(s) lié(s)',
    'field_trainers_name'                       => 'Nom des formateurs',
    'field_acquisition_level'                   => 'Niveau d\'acquisition',
    'field_id'                                  => 'Identifiant',
    'field_symbol'                              => 'Symbole',
    'field_taxonomy'                            => 'Taxonomie',
    'field_linked_comments'                     => 'Commentaires liés',

    // Admin texts
    'admin_apprentices'     => 'Apprentis',
    'admin_course_plans'    => 'Plans de formations',

    // Error messages
    'msg_err_course_plan_not_exist'     => 'Le plan de formation sélectionné n\'existe pas',
    'msg_err_course_plan_not_unique'    => 'Ce plan de formation est déjà utilisé, merci d\'en choisir un autre',
    'associated_op_comp_disabled'       => 'La compétence opérationnelle associée à cet objectif est désactivée',
    'associated_comp_dom_disabled'      => 'Le domaine de compétence associé est désactivé',

    // Other texts
    'course_plan'                                   => 'Plan de formation',
    'course_plan_delete'                            => 'Supprimer ce plan de formation',
    'course_plan_delete_explanation'                => 'Toutes les informations concernant ce plan de formation (domaines de compétences, compétences oppérationnelles et objectifs) seront supprimées.',
    'course_plan_disable'                           => 'Désactiver ce plan de formation',
    'course_plan_disable_explanation'               => 'Toutes les informations concernant ce plan de formation (domaines de compétences, compétences oppérationnelles et objectifs) seront désactivées.',
    'number_abr'                                    => 'No',
    'competence_domain'                             => 'Domaine de compétence',
    'competence_domain_delete'                      => 'Supprimer ce domaine de compétence',
    'competence_domain_delete_explanation'          => 'Toutes les informations concernant ce domaine de compétence (symbole, nom, compétences oppérationnelles et objectifs) seront supprimées.',
    'competence_domain_disable'                     => 'Désactiver ce domaine de compétence',
    'competence_domain_disable_explanation'         => 'Toutes les informations concernant ce domaine de compétence (symbole, nom, compétences oppérationnelles et objectifs) seront désactivées.',
    'operational_competence'                        => 'Compétence opérationnelle',
    'operational_competence_delete'                 => 'Supprimer cette compétence opérationnelle',
    'operational_competence_delete_explanation'     => 'Toutes les informations concernant cette compétence opérationnelle (nom, symbole, compétences, objectifs) seront supprimées.',
    'operational_competence_disable'                => 'Désactiver cette compétence opérationnelle',
    'operational_competence_disable_explanation'    => 'Toutes les informations concernant cette compétence opérationnelle (nom, symbole, compétences, objectifs) seront désactivées.',
    'objective'                                     => 'Objectif',
    'objective_delete'                              => 'Supprimer cet objectif',
    'objective_delete_explanation'                  => 'Toutes les informations concernant cet objectif (symbole, taxonomie, nom) seront supprimées.',
    'objective_disable'                             => 'Désactiver cet objectif',
    'objective_disable_explanation'                 => 'Toutes les informations concernant cet objectif (symbole, taxonomie, nom) seront désactivées.',
    'symbol'                                        => 'Symbole',
    'user_course'                                   => 'Formation liée',
    'user_course_delete'                            => 'Supprimer cette formation liée',
    'user_course_delete_explanation'                => 'Toutes les informations concernant cette formation liée seront supprimées.',
    'user_course_disable'                           => 'Désactiver cette formation liée',
    'user_course_disable_explanation'               => 'Toutes les informations concernant cette formation liée seront désactivées.',
    'apprentice_link'                               => 'Apprenti et formateur liés',
    'apprentice_link_delete'                        => 'Supprimer le lien entre cet apprenti et ce formateur',
    'apprentice_link_delete_explanation'            => 'Toutes les informations concernant le lien entre cet apprenti et ce formateur seront supprimées.',
    'apprentice_link_disable'                       => 'Désactiver le lien entre cet apprenti et ce formateur',
    'apprentice_link_disable_explanation'           => 'Toutes les informations concernant le lien entre cet apprenti et ce formateur seront désactivées.',
    'acquisition_status'                            => 'Statut d\'acquisition',
    'acquisition_status_delete'                     => 'Supprimer le statut d\'acquisition',
    'acquisition_status_delete_explanation'         => 'Toutes les informations concernant le statut d\'acquisition seront supprimées.',
    'acquisition_status_disable'                    => 'Désactiver le statut d\'acquisition',
    'acquisition_status_disable_explanation'        => 'Toutes les informations concernant le statut d\'acquisition seront désactivées.',
    'apprentice'                                    => 'Apprenti',
    'trainer'                                       => 'Formateur',
    'course_status'                                 => 'Status des formations',
    'status'                                        => 'Statut de la formation',
    'form_number_not_unique'                        => 'Le numéro du plan de formation existe déjà',
    'with_status'                                   => 'Avec le statut',

    'course_plan_enable_explanation'                => 'Toutes les informations concernant ce plan de formation (domaines de compétences, compétences oppérationnelles et objectifs) seront réactivées.',
    'competence_domain_enable_explanation'          => 'Toutes les informations concernant ce domaine de compétence (symbole, nom, compétences oppérationnelles et objectifs) seront réactivées.',
    'operational_competence_enable_explanation'     => 'Toutes les informations concernant cette compétence opérationnelle (nom, symbole, compétences, objectifs) seront réactivées.',
    'objective_enable_explanation'                  => 'Toutes les informations concernant cet objectif (symbole, taxonomie, nom) seront réactivées.',
    'user_course_enable_explanation'                => 'Toutes les informations concernant cette formation liée seront réactivées.',
    'apprentice_link_enable_explanation'            => 'Toutes les informations concernant le lien entre cet apprenti et ce formateur seront réactivées.',
    'acquisition_status_enable_explanation'         => 'Toutes les informations concernant le statut d\'acquisition seront réactivées.',

    'apprentices_already_assigned_to_course_plan'   => 'Les apprentis suivants sont déjà associés au plan de formation'
];