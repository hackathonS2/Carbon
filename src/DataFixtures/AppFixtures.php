<?php

namespace App\DataFixtures;

use App\Entity\Comments;
use App\Entity\Mission;
use App\Entity\SoftSkills;
use App\Entity\Categories;
use App\Entity\Note;
use App\Entity\Techno;
use App\Entity\Test;
use App\Entity\TestResults;
use App\Entity\IndicateurTech;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\DateTime;
use function mt_rand;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;
    private $softSkillsList;
    private $technoList;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create('FR-fr');
        $this->softSkillsList = [
            'Autonomie',
            'Capacité d\'adaptation',
            'Communication',
            'Créativité',
            'Curiosité',
            'Esprit d\'équipe',
            'Gestion du stress',
            'Organisation',
            'Persévérance',
            'Polyvalence',
            'Résolution de problèmes',
            'Sens du relationnel',
            'Travail en équipe',
            'Travail sous pression',
            'Volonté'
        ];
        
        $this->technoList = [
            "PHP",
            "Symfony",
            "Laravel",
            "Wordpress",
            "Drupal",
            "Magento",
            "Prestashop",
            "Javascript",
            "React",
            "Angular",
            "VueJS",
            "NodeJS",
            "Express",
            "MongoDB",
            "MySQL",
            "PostgreSQL",
            "Oracle",
            "SQL Server",
            "C#",
            "Java",
            "Python",
            "C++",
            "C",
            "Ruby",
            "Swift",
            "Kotlin",
            "Go",
            "Rust",
            "Dart",
            "Flutter",
            "Ionic",
            "React Native",
            "Xamarin",
            "Kubernetes",
            "Docker",
            "AWS",
            "Azure",
            "Google Cloud",
            "Git",
            "Jenkins",
            "Ansible",
            "Terraform",
            "Linux",
            "Android",
            "iOS"
        ];
    }


    public function load(ObjectManager $entity_manager)
    {
      

        /** users fixtures **/

        $users = [];

        // create users with  ROLE_ADMIN, ROLE_CONSULTANT
        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setPassword($this->hasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setNom('admin');
        $user->setPrenom('admin');
        $user->setTel('0606060606');
        $user->setAdresse($this->faker->address());
        $entity_manager->persist($user);
        $users[] = $user;
 
        // create users with ROLE_COMMERCIAL
        $user = new User();
        $user->setEmail('commercial@commercial.fr');
        $user->setPassword($this->hasher->hashPassword($user, 'commercial'));
        $user->setRoles(['ROLE_COMMERCIAL']);
        $user->setNom('admin');
        $user->setPrenom('commercial');
        $user->setTel('0606060606');
        $user->setAdresse($this->faker->address());
        $entity_manager->persist($user);
        $users[] = $user;

        // create a list of users with ROLE_CONSULTANT
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setPassword($this->hasher->hashPassword($user, 'consultant'));
            $user->setRoles(['ROLE_CONSULTANT']);
            $user->setNom($this->faker->lastName());
            $user->setPrenom($this->faker->firstName());
            $user->setDateDeNaissance(new \DateTime('now'));
            $user->setTel($this->faker->phoneNumber());
            $user->setAdresse($this->faker->address());
            $user->setDescription($this->faker->text(100));
            $user->setSalaireSouhaite($this->faker->numberBetween(35000, 150000));
            $user->setEvalClient($this->faker->numberBetween(0, 5));
            $user->setEvalClientDev($this->faker->numberBetween(0, 5));
            $user->setObjectifMensuelCommercial($this->faker->text(100));
            $user->setLinkLinkedin($this->faker->url());
            $user->setLinkSlack($this->faker->url());
            $entity_manager->persist($user);
            $users[] = $user;
        }


        /** softSkills fixtures **/

        $softSkills = [];

        // for each user, create a list of softSkills
        foreach ($users as $user) {
            for ($i = 0; $i < mt_rand(3, 6); $i++) {
                $softSkill = new SoftSkills();
                $softSkill->setIdUser($user);
                $softSkill->setCredit($this->faker->numberBetween(0, 5));
                $softSkill->setNom($this->softSkillsList[mt_rand(0, count($this->softSkillsList) - 1)]);
                $entity_manager->persist($softSkill);
                $softSkills[] = $softSkill;
            }
        }

        /** mission fixtures **/

        $missions = [];

        // create a list of missions
        for ($i = 0; $i < 10; $i++) {
            $mission = new Mission();
            $mission->setNom($this->faker->text(100));
            $mission->setDateDebut(new \DateTime('now'));
            $mission->setDateFin(new \DateTime('now'));
            $mission->setMailClient($this->faker->email());
            $mission->setNote($this->faker->numberBetween(0, 5));
            $entity_manager->persist($mission);
            $missions[] = $mission;
        }

        // for every mission, create a list of clientNotes
        foreach ($missions as $mission) {
            for ($i = 0; $i < \mt_rand(1, 3); $i++) {
                $clientNote = new Note();
                $clientNote->setMission($mission);
                $clientNote->setCommentaire($this->faker->text(100));
                $clientNote->setEval($this->faker->numberBetween(0, 5));
                $entity_manager->persist($clientNote);
            }
        }

        /** techno fixtures **/

        $technos = [];

        // add a list of techno to database
        foreach ($this->technoList as $techno) {
            $techno = new Techno();
            $techno->setNom($this->technoList[mt_rand(0, count($this->technoList) - 1)]);
            $entity_manager->persist($techno);
            $technos[] = $techno;
        }

        /** tests fixtures **/

        $tests = [];

        // add tests for each techno ranging from starter to expert
        $difficulty_end_name = ['Starter', 'Intermediate', 'Expert'];
        $difficulty = [0, 1, 2];
        foreach ($technos as $techno) {
            for ($i = 0; $i < 3; $i++) {
                $test = new Test();
                $test->setIdTechno($techno);
                $test->setNom($techno->getNom() . ' ' . $difficulty_end_name[$i]);
                $test->setDifficulte($difficulty[$i]);
                $entity_manager->persist($test);
                $tests[] = $test;
            }
        }


          /** testresults fixtures **/

            $testresults = [];

        // for each test create a test result and link it to a user
        foreach ($tests as $test) {
            for ($i = 0; $i < 10; $i++) {
                $testresult = new TestResults();
                $testresult->setIdTest($test);
                $testresult->setIdUser($users[\mt_rand(0, \count($users) - 1)]);
                $testresult->setResult($this->faker->numberBetween(20, 100));
                $entity_manager->persist($testresult);
                $testresults[] = $testresult;
            }
        }

        /** IndicateurTech fixtures **/

        $indicateurTechs = [];

        /* for each user, create list of indicateurTechs for each techno,
        with evalGobalTech of all test results in that techo*/
        foreach ($users as $user) {
            foreach ($technos as $techno) {
                $indicateurTech = new IndicateurTech();
                $indicateurTech->setIdUser($user);
                $indicateurTech->setIdTechno($techno);
                $indicateurTech->setEvaluationGlobalTech($this->faker->numberBetween(20, 100));
                $entity_manager->persist($indicateurTech);
                $indicateurTechs[] = $indicateurTech;
            }
        }


    }


}
?>