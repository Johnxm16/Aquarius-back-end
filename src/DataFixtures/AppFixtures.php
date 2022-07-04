<?php

namespace App\DataFixtures;

use App\Entity\Collecteur;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * l'encoder des mots de passes
     * 
     * @var  UserPasswordEncoderInterface
     */

    private $encoder;

    public function  __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $facker = Factory::create('en_EN');
        for ($i = 0; $i < 20; $i++) {
            $user = new Utilisateur();
            $hashpassword = $this->encoder->encodePassword($user, "Passer1234");
            $user->setPrenom($facker->firstName())
                ->setNom($facker->lastName)
                ->setEmail($facker->email)
                ->setPassword($hashpassword)
                ->setLogin($facker->randomElement(['URIZEN4', 'BAMBAHD4', 'PYROMANE21']))
                ->setTelephone($facker->randomFloat(0, 1000000, 10000000, 100000000, 10000000000))
                ->setGenre($facker->randomElement(['Masculin', 'Feminin']))
                ->setAdresse($facker->address)
                ->setPoint($facker->randomFloat(100, 200, 500));

            $manager->persist($user);
        }
        for ($u = 0; $u < 20; $u++) {
            $user = new Collecteur();
            $hashpassword = $this->encoder->encodePassword($user, "Passer1234");
            $user->setPrenom($facker->firstName())
                ->setNom($facker->lastName)
                ->setTelephone($facker->randomFloat(0, 1000000, 10000000, 100000000, 10000000000))
                ->setPassword($hashpassword)
                ->setGenre($facker->randomElement(['Masculin', 'Feminin']))
                ->setAdresse($facker->address)
                ->setMatricule($facker->randomFloat(100, 200, 500))
                ->setAgence($facker->randomElement(['Malika Factory', 'Kaoplaste', 'Sen Recyclage', 'Mole 8']));

            $manager->persist($user);
        }
        $manager->flush();
    }
}