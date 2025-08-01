<?php

namespace App\DataFixtures;

use App\Factory\ArticleFactory;
use App\Factory\CommentFactory;
use App\Factory\CountryFactory;
use App\Factory\UserFactory;
use App\Factory\GenreFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        UserFactory::createOne([
//            'name' => 'Dupont',
//            'nickname' => 'Georges',
//        ]);
//        UserFactory::createOne([
//            'name' => 'Durand',
//            'nickname' => 'alain',
//        ]);
//        UserFactory::createOne([
//            'name' => 'Ferrier',
//            'nickname' => 'Nathalie',
//        ]);
//
//        UserFactory::createOne([
//            'name' => 'Fessie',
//            'nickname' => 'Sophie',
//        ]);
//        UserFactory::createOne([
//            'name' => 'Richou',
//            'nickname' => 'Anne',
//        ]);
//
//        UserFactory::createOne([
//            'name' => 'Riheu',
//            'nickname' => 'Marine',
//        ]);
//        UserFactory::createOne([
//            'name' => 'Rigard',
//            'nickname' => 'Marie',
//        ]);
//        UserFactory::createOne([
//        'name' => 'Nero',
//        'nickname' => 'Jacques',
//    ]);
//        UserFactory::createOne([
//            'name' => 'Nierat',
//            'nickname' => 'Eric',
//        ]);
//        UserFactory::createOne([
//            'name' => 'Picard',
//            'nickname' => 'Marc',
//        ]);
//        UserFactory::createOne([
//            'name' => 'Muller',
//            'nickname' => 'Annie',
//        ]);
//        UserFactory::createOne([
//        'name' => 'Landry',
//        'nickname' => 'Jean',
//    ]);



      UserFactory::createMany(12);

        GenreFactory::createOne(['label' => 'Instrumental']);
        GenreFactory::createOne(['label' => 'Végétal']);
        GenreFactory::createOne(['label' => 'Géometrique']);
        GenreFactory::createOne(['label' => 'Inclassable']);
        GenreFactory::createOne(['label' => 'Déformé']);
        GenreFactory::createOne(['label' => 'Futuriste']);



        $france = CountryFactory::createOne([
            'label' => 'France',
            'image_path' => 'https://flagshub.com/images/3/flag-of-france.png',
        ]);

        $inde = CountryFactory::createOne([
            'label' => 'Inde',
            'image_path' => 'https://flagshub.com/images/3/flag-of-india.png',
        ]);
        $chine = CountryFactory::createOne([
            'label' => 'Chine',
            'image_path' => 'https://flagshub.com/images/3/flag-of-china.png',
        ]);
        $emu = CountryFactory::createOne([
            'label' => 'Émirats arabes unis',
            'image_path' => 'https://flagshub.com/images/3/flag-of-the-united-arab-emirates.png',
        ]);
        $bresil = CountryFactory::createOne([
            'label' => 'Bresil',
            'image_path' => 'https://flagshub.com/images/3/flag-of-brazil.png',
        ]);
        $espagne = CountryFactory::createOne([
            'label' => 'Espagne',
            'image_path' => 'https://flagshub.com/images/3/flag-of-spain.png',
        ])
        ;
        $canada = CountryFactory::createOne([
            'label' => 'Canada',
            'image_path' => 'https://flagshub.com/images/3/flag-of-canada.png',
        ])
        ;
        $tchequie = CountryFactory::createOne([
            'label' => 'République tchèque',
            'image_path' => 'https://flagshub.com/images/3/flag-of-the-czech-republic.png',
        ])
        ;
        $pologne = CountryFactory::createOne([
        'label' => 'Pologne',
        'image_path' => 'https://flagshub.com/images/3/flag-of-poland.png',
    ])
    ;

        ArticleFactory::createOne([
            'buldingName' => 'Bâtiment de Infosys',
            'city' => 'Pune',
            'country' => $france,
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-3.jpg',
            'owner' => UserFactory::random(),

        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Capital Gate',
            'city' => 'Abu Dhabi',
            'country' => $emu,
////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-7.jpg',
////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),

        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Piano House',
            'city' => 'Anhui',
            'country' => $chine,
////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-9-1536x991.jpg',
////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),

        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Antilia',
            'city' => 'Bombay',
            'country' => $inde,
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-12.jpg',
////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//           'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),

        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Musée d’art contemporain',
            'city' => 'Niterói',
            'country' => $bresil ,
////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-5.jpg',
////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),

        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Edificio Mirador',
            'city' => 'Madrid',
            'country' => $espagne,
////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-8.jpg',
////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//           'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Biosphère',
            'city' => 'Montréal',
            'country' => $canada,
//////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-16.jpg',
//////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//////            'status' => self::faker()->numberBetween(1, 32767),
//////            'title' => self::faker()->text(255),
////
        ]);
        ArticleFactory::createOne([
            'buldingName' => 'Maison dansante',
            'city' => 'Prague',
            'country' => $tchequie,
//////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-21.jpg',
//////            'owner' => UserFactory::new(),
//////            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
//////            'status' => self::faker()->numberBetween(1, 32767),
//////            'title' => self::faker()->text(255),
////
        ]);
        ArticleFactory::createOne([
            'buldingName' => 'La Maison tordue',
            'city' => 'Sopot',
            'country' => $pologne,
//////            'description' => self::faker()->text(),
            'image_path' => 'https://cdn.generationvoyage.fr/2014/10/batiments-monde-brisant-conventions-architecture-traditionnelle-23.jpg',
//////            'owner' => UserFactory::new(),
             'owner' => UserFactory::random(),
////
//////            'status' => self::faker()->numberBetween(1, 32767),
//////            'title' => self::faker()->text(255),
////
        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);
////        ArticleFactory::createOne([
////            'buldingName' => '',
////            'city' => '',
////            'country' => '',
////            'description' => self::faker()->text(),
////            'image_path' => '' ,
////            'owner' => UserFactory::new(),
////            'status' => self::faker()->numberBetween(1, 32767),
////            'title' => self::faker()->text(255),
////
////        ]);

        CommentFactory::createMany(24);
    }
}
