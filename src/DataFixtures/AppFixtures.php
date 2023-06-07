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

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create('FR-fr');
    }


    public function load(ObjectManager $entity_manager)
    {
        // create users with  ROLE_ADMIN, ROLE_CONSULTANT
        $users = new User();
        $users->setEmail('admin@admin.fr');
        $users->setPassword($this->hasher->hashPassword($users, 'admin'));
        $users->setRoles(['ROLE_ADMIN']);
        $users->setNom('admin');
        $users->setPrenom('admin');
        $users->setTel('0606060606');
        $users->setAdresse($this->faker->address());
        $entity_manager->persist($users);
 
         // create users with ROLE_COMMERCIAL
         $users = new User();
         $users->setEmail('commercial@commercial.fr');
         $users->setPassword($this->hasher->hashPassword($users, 'commercial'));
         $users->setRoles(['ROLE_COMMERCIAL']);
         $users->setNom('admin');
         $users->setPrenom('commercial');
         $users->setDateNaissance(new \DateTime('now'));
         $users->setTel('0606060606');
         $users->setAdresse($this->faker->address());
         $entity_manager->persist($users);

        // create a list of users with ROLE_CONSULTANT
        for ($i = 0; $i < 10; $i++) {
            $users = new User();
            $users->setEmail($this->faker->email());
            $users->setPassword($this->hasher->hashPassword($users, 'consultant'));
            $users->setRoles(['ROLE_CONSULTANT']);
            $users->setNom($this->faker->lastName());
            $users->setPrenom($this->faker->firstName());
            $users->setDateNaissance(new \DateTime('now'));
            $users->setTel($this->faker->phoneNumber());
            $users->setAdresse($this->faker->address());
            $users->setDescription($this->faker->text(100));
            $users->setSalaireSouhaite($this->faker->numberBetween(35000, 150000));
            $users->setEvalClient($this->faker->numberBetween(0, 5));
            $users->setEvalClientDev($this->faker->numberBetween(0, 5));
            $users->setObjectifMensuelCommercial($this->faker->text(100));
            $users->setLinkLinkedin($this->faker->url());
            $users->setLinkSlack($this->faker->url());
            $entity_manager->persist($users);
        }

        // create a list of missions
        for ($i = 0; $i < 10; $i++) {
            $missions = new Mission();
            $missions->setNom($this->faker->text(100));
            $missions->setDateDebut(new \DateTime('now'));
            $missions->setDateFin(new \DateTime('now'));
            $missions->setMailClient($this->faker->email());
            $missions->setNote($this->faker->numberBetween(0, 5));
            $entity_manager->persist($missions);
        }
    }


}
?>