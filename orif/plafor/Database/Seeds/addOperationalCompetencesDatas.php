<?php


namespace Plafor\Database\Seeds;


use CodeIgniter\Database\Seeder;

class addOperationalCompetencesDatas extends Seeder
{
    public function run()
    {
        //operational_competence//
        $operational_competence = array(
            array('id' => '1','fk_competence_domain' => '1','name' => 'Analyser, structurer et documenter les exigences ainsi que les besoins','symbol' => 'A1','methodologic' => 'Travail structuré, documentation adéquate','social' => 'Comprendre et sentir les problèmes du client, communication avec des partenaires','personal' => 'Fiabilité, autoréflexion, interrogation constructive du problème','archive' => NULL),
            array('id' => '2','fk_competence_domain' => '1','name' => 'Elaborer diverses propositions de solutions incluant les interfaces utilisateurs requises','symbol' => 'A2','methodologic' => 'Travail structuré, documentation adéquate, appliquer des techniques de créativité, techniques de décision','social' => 'Comprendre et sentir les problèmes du client, communication avec des partenaires, modération, travail en réseau','personal' => 'Interrogation constructive du problème, s’informer de manière autonome sur les diverses solutions','archive' => NULL),
            array('id' => '3','fk_competence_domain' => '1','name' => 'Vérifier l’exhaustivité des exigences et des besoins dans les propositions de solution choisies','symbol' => 'A3','methodologic' => 'Techniques de validation, assurance qualité, techniques de présentation  et de démonstration','social' => '','personal' => 'Précision dans le travail','archive' => NULL),
            array('id' => '4','fk_competence_domain' => '2','name' => 'Elaborer un concept de tests, mettre en application divers déroulements de tests et tester systématiquement les applications ','symbol' => 'B1','methodologic' => '','social' => 'Capacité de critique mutuelle','personal' => 'Développer préventivement, estimer les conséquences','archive' => NULL),
            array('id' => '5','fk_competence_domain' => '2','name' => 'Mettre en œuvre des directives d’architecture dans un projet concret','symbol' => 'B2','methodologic' => '','social' => '','personal' => 'Capacités d’abstraction','archive' => NULL),
            array('id' => '6','fk_competence_domain' => '2','name' => 'Développer et documenter des applications conformément aux besoins du client en utilisant des modèles appropriés de déroulement','symbol' => 'B3','methodologic' => 'Travail structuré et systématique, capacités d‘abstraction, compétences de modélisation, acquisition d‘informations, développer efficacement, tenir compte de la charge du réseau','social' => 'Travail en groupe, capacités de communication, capacités de critiques, orientation client, disponibilités pour la reprise de l‘existant','personal' => 'Penser économies d‘entreprises, persévérance, conscience de la qualité, capacité de compréhension rapide','archive' => NULL),
            array('id' => '7','fk_competence_domain' => '2','name' => 'Implémenter des applications et des interfaces utilisateurs en fonction des besoins du client et du projet','symbol' => 'B4','methodologic' => 'Orientation client, développement approprié au marché, appliquer des techniques innovatrices','social' => 'Travail en groupe, empathie','personal' => 'Capacités innovatrices, créativité','archive' => NULL),
            array('id' => '8','fk_competence_domain' => '2','name' => 'Garantir la qualité des applications','symbol' => 'B5','methodologic' => 'Travail reproductible, description propres des versions de l‘application, gestion de projets','social' => 'Capacité de critiques et de conflits, empathie','personal' => 'Vérification autocritique des résultats, méticulosité','archive' => NULL),
            array('id' => '9','fk_competence_domain' => '2','name' => 'Préparer et mettre en œuvre l’introduction des applications','symbol' => 'B6','methodologic' => 'Gestion de projets','social' => 'Capacités de communication, travail en réseau, déroulement sensible','personal' => 'Conscience de la responsabilité','archive' => NULL),
            array('id' => '10','fk_competence_domain' => '3','name' => 'Identifier et analyser des données, puis développer avec des modèles de données appropriés','symbol' => 'C1','methodologic' => 'Déroulement structuré, comportement avec des outils de présentation, développement itératif','social' => 'Communication avec des clients, travail en groupe','personal' => 'Précision, abstraction, remise en question critique','archive' => NULL),
            array('id' => '11','fk_competence_domain' => '3','name' => 'Mettre en œuvre un modèle de données dans une base de données','symbol' => 'C2','methodologic' => '','social' => '','personal' => 'Capacité d’abstraction','archive' => NULL),
            array('id' => '12','fk_competence_domain' => '3','name' => 'Accéder à des données à partir d’applications avec un langage approprié','symbol' => 'C3','methodologic' => '','social' => '','personal' => '','archive' => NULL),
            array('id' => '13','fk_competence_domain' => '4','name' => 'Installer et configurer, selon des directives, des postes de travail ainsi que des services de serveurs dans l’exploitation locale du réseau','symbol' => 'D1','methodologic' => 'Considération de la valeur utile, déroulement systématique, check liste, méthode de travail durable économiquement, écologiquement, socialement','social' => 'Orientation client, communication écrite et orale','personal' => 'Autoréflexion critique','archive' => NULL),
            array('id' => '14','fk_competence_domain' => '5','name' => 'Préparer, structurer et documenter des travaux et mandats de manière systématique et efficace','symbol' => 'E1','methodologic' => 'Déroulement structuré, déroulement systématique selon check list, documentation des travaux','social' => 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles','personal' => 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise','archive' => NULL),
            array('id' => '15','fk_competence_domain' => '5','name' => 'Collaborer à des projets et travailler selon des méthodes de projets','symbol' => 'E2','methodologic' => 'Méthodes de travail, pensée transversale, considération des variantes, analyse des grandeurs utiles, pensée en réseau, techniques de présentation et de ventes','social' => 'Faculté de travail en groupe, développer et mettre en œuvre selon les besoins, communiquer selon le niveau et les utilisateurs, comportement respectueux et adapté avec les collaborateurs','personal' => 'Réflexion, disposé à l‘apprentissage, intérêts, capacité decritiques, capacité d’endurance jusqu’à la conclusion','archive' => NULL),
            array('id' => '16','fk_competence_domain' => '5','name' => 'Dans le cadre de projets, communiquer de manière ciblée et adaptée à l’interlocuteur','symbol' => 'E3','methodologic' => 'Méthodes de travail, pensée en réseau, techniques de présentation et de ventes','social' => 'Travail en groupe, communiquer conformément au niveau et aux utilisateurs, comportement respectueux et approprié avec toutes les personnes de contact à tous les niveaux, communication précise
','personal' => 'Réflexion, prêt à apprendre, intérêt, capacité de critiques, capacité de résistance','archive' => NULL),
            array('id' => '17','fk_competence_domain' => '6','name' => 'Evaluer et mettre en service une place de travail utilisateur','symbol' => 'A1','methodologic' => 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)','social' => 'Orientation client, communication écrite et orale','personal' => 'Conscience de la responsabilité, fiabilité, autoréflexion critique','archive' => NULL),
            array('id' => '18','fk_competence_domain' => '6','name' => 'Installer et synchroniser sur le réseau interne des appareils mobiles des utilisateurs','symbol' => 'A2','methodologic' => 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)','social' => 'Orientation client, communication écrite et orale, comportement convivial avec le client','personal' => 'Conscience de la responsabilité, fiabilité, autoréflexion critique','archive' => NULL),
            array('id' => '19','fk_competence_domain' => '6','name' => 'Connecter et configurer des appareils périphériques','symbol' => 'A3','methodologic' => 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)','social' => 'Orientation client, communication écrite et orale, langage adapté au client','personal' => 'Conscience de la responsabilité, fiabilité, autoréflexion critique','archive' => NULL),
            array('id' => '20','fk_competence_domain' => '7','name' => 'Mettre en service des systèmes serveurs','symbol' => 'B1','methodologic' => 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)','social' => 'Orientation client, communication écrite et orale','personal' => 'Autoréflexion critique','archive' => NULL),
            array('id' => '21','fk_competence_domain' => '7','name' => 'Installer des réseaux et leurs topologies','symbol' => 'B2','methodologic' => 'Déroulement analytique, principe de Pareto, techniques de visualisation, diagrammes, techniques de décision','social' => 'Faire des entretiens professionnels en anglais','personal' => 'Méthode précise de travail, conscience de la responsabilité, capacités d’abstraction','archive' => NULL),
            array('id' => '22','fk_competence_domain' => '7','name' => 'Elaborer et mettre en œuvre des concepts de sécurité des données, de sécurité système et d’archivage','symbol' => 'B3','methodologic' => 'Actions préventives','social' => 'Conseil','personal' => 'Penser et travailler de manière disciplinée, comportement dans les situations de stress','archive' => NULL),
            array('id' => '23','fk_competence_domain' => '8','name' => 'Assurer la maintenance de réseaux et les développer','symbol' => 'C1','methodologic' => 'déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)','social' => '','personal' => 'Précision, fiable, actions attentives','archive' => NULL),
            array('id' => '24','fk_competence_domain' => '8','name' => 'Assurer la maintenance et administrer des serveurs','symbol' => 'C2','methodologic' => 'Pensée systématique et préventive, considération de l’ensemble, remise en question systématique, travail durable (économiquement, écologiquement, socialement)','social' => 'Travail en groupe, entretien professionnel en anglais','personal' => 'Travail patient et autocritique, conscience de la qualité, autoréflexion, éthique, discrétion, discipline','archive' => NULL),
            array('id' => '25','fk_competence_domain' => '8','name' => 'Planifier, mettre en œuvre des services d’annuaires et des autorisations','symbol' => 'C3','methodologic' => 'Techniques d’interrogation','social' => 'Empathie','personal' => 'Comprendre et interpréter des documents anglais','archive' => NULL),
            array('id' => '26','fk_competence_domain' => '8','name' => 'Mettre en service et configurer des services de communication et de soutien des travaux de groupe (groupeware)','symbol' => 'C4','methodologic' => 'Techniques d’entretien, pensée systématique et préventive, considération de l’ensemble, remise en question systématique','social' => 'Travailler en groupe','personal' => 'Travail patient et auto-critique, sens de la qualité, autoreflexion','archive' => NULL),
            array('id' => '27','fk_competence_domain' => '9','name' => 'Instruire et aider les utilisateurs dans l’utilisation des moyens informatiques','symbol' => 'D1','methodologic' => 'Techniques d’interrogation, déroulement structuré, travailler selon checklist, établir des documents de première aide','social' => 'Capacité de communication, comportement avec autrui en situation de stress, comportement selon le niveau hiérarchique','personal' => 'Garder le calme, résistance au stress, maîtriser sa propre nervosité','archive' => NULL),
            array('id' => '28','fk_competence_domain' => '9','name' => 'Assurer des tâches de support par le biais du contact client et résoudre les problèmes sur place','symbol' => 'D2','methodologic' => 'Techniques d’interrogation, déroulement structuré, travailler selon checklist','social' => 'Capacité de communication, comportement avec autrui en situation de stress, comportement selon le niveau hiérarchique','personal' => 'Garder le calme, résistance au stress, maîtriser sa propre nervosité','archive' => NULL),
            array('id' => '29','fk_competence_domain' => '10','name' => 'Elaborer des concepts de tests, mettre en application divers déroulements de tests et tester systématiquement les applications ','symbol' => 'E1','methodologic' => '','social' => 'Capacité de critique mutuelle','personal' => 'Développer préventivement, estimer les conséquences','archive' => NULL),
            array('id' => '30','fk_competence_domain' => '10','name' => 'Développer et documenter des applications de manière conviviale en utilisant des modèles appropriés de déroulement','symbol' => 'E2','methodologic' => 'Utiliser efficacement l’environnement logiciels, travail systématique et structuré, capacités d’abstraction, compétences en modélisation, acquisition d’informations, développer efficacement, observer la charge du réseau','social' => 'Travail en groupe, capacités de communication, de critique, de compromis, orientation client, disponibilité, reprise de l’existant','personal' => 'Pensée économique, capacité de résistance, conscience de la qualité, capacité de saisie rapide','archive' => NULL),
            array('id' => '31','fk_competence_domain' => '10','name' => 'Développer et implémenter des interfaces utilisateurs pour des applications selon les besoins du client','symbol' => 'E3','methodologic' => 'Orientation client, concept centré sur l’utilisateur, application de techniques innovantes','social' => 'Travail en groupe, empathie','personal' => 'Capacité d’innovation, créativité','archive' => NULL),
            array('id' => '32','fk_competence_domain' => '10','name' => 'Mettre en œuvre des modèles de données dans une base de données','symbol' => 'E4','methodologic' => '','social' => '','personal' => 'Capacité d’abstraction','archive' => NULL),
            array('id' => '33','fk_competence_domain' => '10','name' => 'Accéder à des données à partir d’applications avec un langage approprié','symbol' => 'E5','methodologic' => '','social' => '','personal' => '','archive' => NULL),
            array('id' => '34','fk_competence_domain' => '11','name' => 'Préparer, structurer, exécuter et documenter des travaux et des mandats de manière systématique et efficace','symbol' => 'F1','methodologic' => 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux','social' => 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles','personal' => 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise','archive' => NULL),
            array('id' => '35','fk_competence_domain' => '11','name' => 'Collaborer à des projets','symbol' => 'F2','methodologic' => 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux','social' => 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles','personal' => 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise, réfléchir en commun dans le projet','archive' => NULL),
            array('id' => '36','fk_competence_domain' => '11','name' => 'Dans le cadre de projets, communiquer de manière ciblée et adaptée à l’interlocuteur','symbol' => 'F3','methodologic' => 'Méthodes de travail, pensée en réseau, techniques de présentation et de ventes','social' => 'Travail en groupe, communiquer conformément au niveau et aux utilisateurs, comportement respectueux et approprié avec toutes les personnes de contact à tous les niveaux, communication précise','personal' => 'Réflexion, prêt à apprendre, intérêt, capacité de critiques, capacité de résistance','archive' => NULL),
            array('id' => '42','fk_competence_domain' => '12','name' => 'Choisir et mettre en service une place de travail utilisateur','symbol' => 'A1','methodologic' => 'Analyse des valeurs utiles, déroulement systématique,
faire des checklists, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement).','social' => 'Orientation client, communication écrite et orale.','personal' => 'Conscience de la responsabilité, fiabilité, auto-réflexion critique.','archive' => NULL),
            array('id' => '43','fk_competence_domain' => '12','name' => 'Choisir et mettre en service des systèmes serveurs','symbol' => 'A2','methodologic' => 'Analyse des valeurs utiles, déroulement systématique, faire des
checklists, travail durable (économiquement, écologiquement,
socialement).','social' => 'Orientation client, communication écrite et orale.','personal' => 'Auto-réflexion critique.','archive' => NULL),
            array('id' => '44','fk_competence_domain' => '12','name' => 'Choisir des composants réseau et les mettre en service','symbol' => 'A3','methodologic' => 'Analyse des valeurs utiles, déroulement systématique, faire des
checklists, technique commerciale, méthode durable de travail
(économiquement, écologiquement, socialement).','social' => 'Communication écrite et orale, empathie, travail en groupe,
langage adapté au public cible.','personal' => 'Auto-réflexion critique, capacités d‘abstraction.','archive' => NULL),
            array('id' => '45','fk_competence_domain' => '13','name' => 'Planifier et installer des réseaux ainsi que leur topologie','symbol' => 'B1','methodologic' => 'Déroulement analytique, principe de Pareto, techniques de visualisation, diagrammes, techniques de décision.','social' => 'Faire des entretiens professionnels en anglais.','personal' => 'Méthode précise de travail, conscience de la responsabilité,
capacités d’abstraction.','archive' => NULL),
            array('id' => '46','fk_competence_domain' => '13','name' => 'Planifier et assurer la sécurité réseau ainsi que l’accès distant','symbol' => 'B2','methodologic' => 'Déroulement analytique, principe de Pareto.','social' => 'Reconnaître et classer les besoins en sécurité du client.','personal' => 'Travail précis, conscience de la responsabilité.','archive' => NULL),
            array('id' => '47','fk_competence_domain' => '13','name' => 'Surveiller des réseaux et garantir leur sécurité et leur capacité de fonctionnement','symbol' => 'B3','methodologic' => 'Agir de manière préventive.','social' => 'Conscience de la hiérarchie.','personal' => 'Discrétion (comportement avec des données confidentielles), fiabilité, précision.','archive' => NULL),
            array('id' => '48','fk_competence_domain' => '13','name' => 'Planifier, installer et exploiter des systèmes de sauvegarde de données en réseau','symbol' => 'B4','methodologic' => 'Agir de manière préventive.','social' => '','personal' => 'Discrétion (comportement avec des données confidentielles), fiabilité, précision, éthique, discrétion, secret professionnel.','archive' => NULL),
            array('id' => '49','fk_competence_domain' => '14','name' => 'Planifier, mettre en œuvre des services d’annuaires et des autorisations','symbol' => 'C1','methodologic' => 'Techniques d’interrogation.','social' => 'Empathie.','personal' => 'Comprendre et interpréter des documents anglais.','archive' => NULL),
            array('id' => '50','fk_competence_domain' => '14','name' => 'Mettre en service et configurer les services étendus des serveurs','symbol' => 'C2','methodologic' => 'Techniques d‘entretiens, pensées préventive et systématique,
considération globale, remise en question systématique.','social' => 'Travail en groupe.','personal' => 'Travail patient et auto-critique, sens de la qualité, auto-réflexion.','archive' => NULL),
            array('id' => '51','fk_competence_domain' => '14','name' => 'Mettre en service et configurer des services de communication ainsi que de soutien des travaux de groupe (groupeware)','symbol' => 'C3','methodologic' => 'Techniques d’entretien, pensée systématique et préventive,
considération de l’ensemble, remise en question systématique.','social' => 'Travailler en groupe.','personal' => 'Travail patient et auto-critique, sens de la qualité, auto-réflexion.','archive' => NULL),
            array('id' => '52','fk_competence_domain' => '14','name' => 'Élaborer et mettre en œuvre des concepts de sécurité des données, de sécurité des systèmes et d’archivage','symbol' => 'C4','methodologic' => 'Actions préventives.','social' => 'Conseil.','personal' => 'Penser et travailler de manière disciplinée, comportement dans les situations de stress.','archive' => NULL),
            array('id' => '53','fk_competence_domain' => '14','name' => 'Offrir des services via le réseau en prenant des mesures de sécurité','symbol' => 'C5','methodologic' => 'Techniques d’entretien, pensée systématique et préventive,
considération de l’ensemble, remise en question systématique.','social' => 'Travailler en groupe.','personal' => 'Travail patient et auto-critique, sens de la qualité, auto-réflexion.','archive' => NULL),
            array('id' => '54','fk_competence_domain' => '15','name' => 'Assurer la maintenance de réseaux et les développer','symbol' => 'D1','methodologic' => 'Déroulement systématique, faire des checklists, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement).','social' => '','personal' => 'Précision, fiable, actions attentives.','archive' => NULL),
            array('id' => '55','fk_competence_domain' => '15','name' => 'Assurer la maintenance et administrer des serveurs','symbol' => 'D2','methodologic' => 'Pensée systématique et préventive, considération de l’ensemble, remise en question systématique, travail durable
(économiquement, écologiquement, socialement).','social' => 'Travail en groupe, entretien professionnel en anglais.','personal' => 'Travail patient et autocritique, conscience de la qualité, auto-réflexion, éthique, discrétion, discipline.','archive' => NULL),
            array('id' => '56','fk_competence_domain' => '15','name' => 'Assurer la maintenance et administrer les équipements des utilisateurs','symbol' => 'D3','methodologic' => 'Pensée systématique et préventive, considération de l’ensemble, remise en question systématique.','social' => 'Travail en groupe, comportement diplomatique avec les utilisateurs.','personal' => 'Travail patient et autocritique, conscience de la qualité, auto-réflexion.','archive' => NULL),
            array('id' => '57','fk_competence_domain' => '15','name' => 'Enregistrer, standardiser et automatiser des processus TIC','symbol' => 'D4','methodologic' => 'Déroulement structuré et orienté objectif, pensée et action préventive.','social' => 'Conseil, comportement dans des situations de stress.','personal' => 'Penser et travailler de manière disciplinée.','archive' => NULL),
            array('id' => '58','fk_competence_domain' => '15','name' => 'Planifier, mettre en service et appliquer des systèmes de déploiement pour des applications','symbol' => 'D5','methodologic' => 'Pensée préventive.','social' => 'Appliquer l’anglais oralement et par écrit.','personal' => 'Réflexion, discipline et capacité d‘endurance.','archive' => NULL),
            array('id' => '59','fk_competence_domain' => '16','name' => 'Préparer, structurer et documenter des travaux et mandats de manière systématique et efficace','symbol' => 'E1','methodologic' => 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux.','social' => 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles.','personal' => 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise.','archive' => NULL),
            array('id' => '60','fk_competence_domain' => '16','name' => 'Collaborer à des projets','symbol' => 'E2','methodologic' => 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux.','social' => 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles.','personal' => 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise, réfléchir en commun dans le projet.','archive' => NULL),
            array('id' => '61','fk_competence_domain' => '16','name' => 'Dans le cadre de projets, communiquer de manière ciblée et adaptée à l’interlocuteur','symbol' => 'E3','methodologic' => 'Méthodes de travail, pensée en réseau, techniques de présentation et de ventes.','social' => 'Travail en groupe, communiquer conformément au niveau et aux utilisateurs, comportement respectueux et approprié avec toutes les personnes de contact à tous les niveaux, communication précise.','personal' => 'Réflexion, prêt à apprendre, intérêt, capacité de critiques, capacité de résistance.','archive' => NULL),
            array('id' => '62','fk_competence_domain' => '17','name' => 'Installer et configurer des terminaux ICT utilisateurs ainsi que des systèmes d’exploitation et en assurer la maintenance','symbol' => 'A1','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement écologique et économique.','social' => 'Capacité à communiquer, aptitude au travail en équipe.','personal' => 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.','archive' => NULL),
            array('id' => '63','fk_competence_domain' => '17','name' => 'Installer et configurer des applications standard','symbol' => 'A2','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement économique.','social' => '','personal' => 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.','archive' => NULL),
            array('id' => '64','fk_competence_domain' => '17','name' => 'Exécuter et évaluer des tests de fonctionnalité','symbol' => 'A3','methodologic' => 'Techniques de travail, comportement économique.','social' => '','personal' => 'Autonomie et responsabilité.','archive' => NULL),
            array('id' => '65','fk_competence_domain' => '17','name' => 'Mettre en œuvre des scripts d’automatisation','symbol' => 'A4','methodologic' => 'Techniques de travail, comportement économique.','social' => '','personal' => 'Autonomie et responsabilité.','archive' => NULL),
            array('id' => '66','fk_competence_domain' => '18','name' => 'Connecter à l’infrastructure réseau des périphériques compatibles réseau ainsi que des services connexes et résoudre les pannes','symbol' => 'B1','methodologic' => 'Techniques de travail, approche et actions interdisciplinaires, comportement économique.','social' => 'Capacité à communiquer, aptitude au travail en équipe.','personal' => 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.','archive' => NULL),
            array('id' => '67','fk_competence_domain' => '18','name' => 'Connecter des terminaux ICT utilisateurs aux prestations de serveur et résoudre les pannes','symbol' => 'B2','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement économique.','social' => 'Capacité à communiquer, aptitude au travail en équipe.','personal' => 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.','archive' => NULL),
            array('id' => '68','fk_competence_domain' => '18','name' => 'Assurer la sécurité des terminaux ICT utilisateurs','symbol' => 'B3','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement économique.','social' => 'Capacité à communiquer.','personal' => 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.','archive' => NULL),
            array('id' => '69','fk_competence_domain' => '19','name' => 'Instruire et soutenir les utilisateurs dans la mise en œuvre des moyens ICT','symbol' => 'C1','methodologic' => 'Techniques de travail, techniques de présentation, comportement économique.','social' => 'Capacité à communiquer.','personal' => 'Capacité à analyser sa pratique, autonomie et responsabilité, résistance au stress, flexibilité.','archive' => NULL),
            array('id' => '70','fk_competence_domain' => '19','name' => 'Élaborer et adapter des modes d’emploi et checklists pour les utilisateurs','symbol' => 'C2','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, techniques de présentation, comportement économique.','social' => 'Capacité à communiquer.','personal' => 'Autonomie et responsabilité, flexibilité.','archive' => NULL),
            array('id' => '71','fk_competence_domain' => '19','name' => 'Conseiller et soutenir les clients lors de l’acquisition d’appareils terminaux ICT','symbol' => 'C3','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, techniques de présentation, comportement économique.','social' => 'Capacité à communiquer, aptitude au travail en équipe.','personal' => 'Autonomie et responsabilité, flexibilité.','archive' => NULL),
            array('id' => '72','fk_competence_domain' => '20','name' => 'Traiter les demandes des clients au 1er et 2e niveau du support','symbol' => 'D1','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, techniques de présentation, stratégies d’information et de communication, économique.','social' => 'Capacité à communiquer, aptitude au travail en équipe.','personal' => 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.','archive' => NULL),
            array('id' => '73','fk_competence_domain' => '20','name' => 'Se comporter de manière adéquate avec les clients et l’équipe','symbol' => 'D2','methodologic' => 'Techniques de travail, stratégies d’information et de communication.','social' => 'Capacité à communiquer, capacité à gérer des conflits, aptitude au travail en équipe.','personal' => 'Capacité à analyser sa pratique, autonomie et responsabilité.','archive' => NULL),
            array('id' => '74','fk_competence_domain' => '20','name' => 'Exécuter, selon des méthodes spécifiques, les travaux dans l’environnement ICT et collaborer à des projets','symbol' => 'D3','methodologic' => 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, stratégies d’information et de communication, comportement économique.','social' => 'Capacité à communiquer, aptitude au travail en équipe.','personal' => 'Autonomie et responsabilité, flexibilité.','archive' => NULL)
        );
        foreach ($operational_competence as $operational_competencee){
            $this->db->table('operational_competence')->insert($operational_competencee);
        }
    }
}