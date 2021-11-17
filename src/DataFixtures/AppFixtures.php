<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $faker = Faker\Factory::create();
        
        $users = [];
        
        for ($i=0; $i < 50; $i++) {
            $user = new User();
            
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTimeImmutable());
            
            $manager->persist($user);
            
            $users[] = $user;
        }
        
        $categories = [];
        
        
        
        for ($i=0; $i < 15; $i++) {
            $category = new Category();
            
            $category->setTitle($faker->text(50));
//            $category->setTitle("aaaaaaaaaaaaaaaa");
            
            $category->setDescription($faker->text(250));
//            $category->setDescription("bbbbbbbbbbbbbbb");
            
            $category->setImage($faker->imageUrl());
            
            $manager->persist($category);
            
            $categories[] = $category;
        }
        
        
        
        for ($i=0; $i < 100; $i++) {
            $publication = new Publication();
            
            $publication->setTitle($faker->text(50));
            $publication->setContent($faker->text(6000));
            $publication->setImage($faker->imageUrl());
            $publication->setCreatedAt(new \DateTimeImmutable());
            $publication->addCategory($categories[$faker->numberBetween(0,14)]);
            $publication->setAuthor($users[$faker->numberBetween(0,14)]);
            $manager->persist($publication);
        }
        
        
        

        $manager->flush();
    }
}
