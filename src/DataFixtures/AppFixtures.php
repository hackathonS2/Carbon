<?php

namespace App\DataFixtures;

use App\Entity\Actualite;
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

        $url =[
            'https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png',
            'https://cdn-icons-png.flaticon.com/512/147/147142.png',
            'https://static.vecteezy.com/system/resources/previews/006/487/917/original/man-avatar-icon-free-vector.jpg',
            'https://cdn-icons-png.flaticon.com/512/5556/5556468.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png',
            'https://cdn.icon-icons.com/icons2/1371/PNG/512/batman_90804.png',
            'https://www.svgrepo.com/show/382106/male-avatar-boy-face-man-user-9.svg',
            'https://cdn.icon-icons.com/icons2/3708/PNG/512/man_person_people_avatar_icon_230017.png',
            'https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/11_avatar-512.png',
            'https://w7.pngwing.com/pngs/129/292/png-transparent-female-avatar-girl-face-woman-user-flat-classy-users-icon.png',
            'https://cdn-icons-png.flaticon.com/512/3641/3641963.png'
        ];

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
        $user->setIsVerified(true);
        $user->setAvatar("http://i.pravatar.cc/103");
        $user->setImgUrl($url[mt_rand(0,10)]);
        $entity_manager->persist($user);
        $users[] = $user;
 
        // create users with OPERATIONNEL
        $user = new User();
        $user->setEmail('operationnel@operationnel.fr');
        $user->setPassword($this->hasher->hashPassword($user, 'operationnel'));
        $user->setRoles(['ROLE_OPERATIONNEL']);
        $user->setNom('admin');
        $user->setPrenom('operationnel');
        $user->setTel('0606060606');
        $user->setAdresse($this->faker->address());
        $user->setAvatar("http://i.pravatar.cc/104");
        $user->setImgUrl($url[mt_rand(0,10)]);
        $user->setIsVerified(true);
        $entity_manager->persist($user);
        $users[] = $user;
        $url =[
            'https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png',
            'https://cdn-icons-png.flaticon.com/512/147/147142.png',
            'https://static.vecteezy.com/system/resources/previews/006/487/917/original/man-avatar-icon-free-vector.jpg',
            'https://cdn-icons-png.flaticon.com/512/5556/5556468.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png',
            'https://cdn.icon-icons.com/icons2/1371/PNG/512/batman_90804.png',
            'https://www.svgrepo.com/show/382106/male-avatar-boy-face-man-user-9.svg',
            'https://cdn.icon-icons.com/icons2/3708/PNG/512/man_person_people_avatar_icon_230017.png',
            'https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/11_avatar-512.png',
            'https://w7.pngwing.com/pngs/129/292/png-transparent-female-avatar-girl-face-woman-user-flat-classy-users-icon.png',
            'https://cdn-icons-png.flaticon.com/512/3641/3641963.png'
        ];


        // create users with CONSULTANT
        $user = new User();
        $user->setEmail('consultant@consultant.fr');
        $user->setPassword($this->hasher->hashPassword($user, 'consultant'));
        $user->setRoles(['ROLE_CONSULTANT']);
        $user->setNom('consultant');
        $user->setPrenom('consultant');
        $user->setTel('0606060606');
        $user->setAdresse($this->faker->address());
        $user->setIsVerified(true);
        $entity_manager->persist($user);
        $users[] = $user;
        $url =[
            'https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png',
            'https://cdn-icons-png.flaticon.com/512/147/147142.png',
            'https://static.vecteezy.com/system/resources/previews/006/487/917/original/man-avatar-icon-free-vector.jpg',
            'https://cdn-icons-png.flaticon.com/512/5556/5556468.png',
            'https://mir-s3-cdn-cf.behance.net/project_modules/disp/ce54bf11889067.562541ef7cde4.png',
            'https://cdn.icon-icons.com/icons2/1371/PNG/512/batman_90804.png',
            'https://www.svgrepo.com/show/382106/male-avatar-boy-face-man-user-9.svg',
            'https://cdn.icon-icons.com/icons2/3708/PNG/512/man_person_people_avatar_icon_230017.png',
            'https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/11_avatar-512.png',
            'https://w7.pngwing.com/pngs/129/292/png-transparent-female-avatar-girl-face-woman-user-flat-classy-users-icon.png',
            'https://cdn-icons-png.flaticon.com/512/3641/3641963.png'
        ];

        // create a list of users with ROLE_CONSULTANT
        for ($i = 0; $i < 10; $i++) {
            $user = new User();


            $picture = 'http://i.pravatar.cc/';
            $pictureId = $this->faker->numberBetween(105, 300);

            $user->setEmail($this->faker->email());
            $user->setPassword($this->hasher->hashPassword($user, 'consultant'));
            $user->setRoles(['ROLE_CONSULTANT']);
            $user->setNom($this->faker->lastName());
            $user->setPrenom($this->faker->firstName());
            $user->setDateDeNaissance(new \DateTime('now'));
            $user->setTel($this->faker->phoneNumber());
            $user->setAdresse($this->faker->address());
            $user->setDescription($this->faker->text(100));
            $user->setAvatar($picture . $pictureId);
            $user->setSalaireSouhaite($this->faker->numberBetween(35000, 150000));
            $user->setEvalClient($this->faker->numberBetween(0, 5));
            $user->setEvalClientDev($this->faker->numberBetween(0, 5));
            $user->setObjectifMensuelCommercial($this->faker->text(100));
            $user->setLinkLinkedin($this->faker->url());
            $user->setLinkSlack($this->faker->url());
            $user->setIsVerified(true);
            $user->setImgUrl($url[$i]);
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

        // create 3 missions for every users note 2 of them
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $mission = new Mission();
                $mission->setNom($this->faker->jobTitle());
                $mission->setDateDebut(new \DateTime('now'));
                $mission->setDateFin( new \DateTime('now + 12 month'));
                $mission->setMailClient($this->faker->email());
                $mission->setDescription($this->faker->realTextBetween($minNbChars = 360, $maxNbChars = 500, $indexSize = 2));
               if($i > 0){
                $mission->setNote($this->faker->numberBetween(1, 5));
               }
                $mission->setConsultant($user);
                $entity_manager->persist($mission);
                $missions[] = $mission;
            }
        }


        // for every mission, create a list of clientNotes
        foreach ($missions as $mission) {
            for ($i = 0; $i < \mt_rand(1, 3); $i++) {
                $clientNote = new Note();
                $clientNote->setMission($mission);
                $clientNote->setCommentaire($this->faker->realTextBetween($minNbChars = 360, $maxNbChars = 500, $indexSize = 2));
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
            $techno->setDescription($this->faker->realTextBetween($minNbChars = 360, $maxNbChars = 500, $indexSize = 2));
            $techno->setUrlFormation($this->faker->url());
            $entity_manager->persist($techno);
            $technos[] = $techno;
        }

        /** tests fixtures **/

        $tests = [];

        // add tests for each techno ranging from starter to expert
        $difficulty = [1, 2, 3];
        foreach ($technos as $techno) {
            for ($i = 0; $i < 3; $i++) {
                $test = new Test();
                $test->setIdTechno($techno);
                $test->setActif(true);
                $test->setNom($techno->getNom());
                $test->setDifficulte($difficulty[$i]);
                $entity_manager->persist($test);
                $tests[] = $test;
            }
        }


          /** testresults fixtures **/

            $testresults = [];

        // for each test create a test result and link it to a user

        foreach($users as $user ) {
            $validateTwo = 2;
            //get 6 first tests from $tests
            $first6 = array_slice($tests, 0, 6);
            foreach ($first6 as $test) {
                if($validateTwo > 0) {
                    // for each user add a testresult
                    $testresult = new TestResults();
                    $testresult->setIdTest($test);
                    $testresult->setIdUser($user);
                    $testresult->setDate(new \DateTime('now'));
                    $testresult->setResult($this->faker->numberBetween(70, 100));
                    $entity_manager->persist($testresult);
                    $testresults[] = $testresult;
                    $validateTwo--;
                }else{
                    $validateTwo = 2;
                }
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

        for ($i=0; $i< 35 ; $i++)
        {
            $actualite = new Actualite();
            $actualite->setTitle($this->faker->title());
            $actualite->setDescription($this->faker->realText($maxNbChars = 200, $indexSize = 2));
            $entity_manager->persist($actualite);
        }


        $entity_manager->flush();


    }






}
?>