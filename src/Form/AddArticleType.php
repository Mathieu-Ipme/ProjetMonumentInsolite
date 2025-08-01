<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',null, [
                    'label' => 'Titre',
                    'attr' => [
                        'class' => 'form-control',
                    ]
 ])
            ->add('description', null, [
                    'label' => 'Description',
                    'attr' => [
                        'class' => 'form-control',
                    ]
])
            ->add('image_path',null, [
                    'label' => 'Image',
                    'attr' => [
                        'class' => 'form-control',
                    ]]
 )
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Validé' => 100,
                    'Pas validé' => 500
                ]
            ])
            ->add('city',null, [
                    'label' => 'Ville',
                    'attr' => [
                        'class' => 'form-control',
                    ]]
 )
            ->add('buldingName', null, [
                    'label' => 'Nom du batiment',
                    'attr' => [
                        'class' => 'form-control',
                    ]
])
//            ->add('publishedAt')
//            ->add('slug')
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'label',
            ])
//            ->add('owner', EntityType::class, [
//                'class' => User::class,
//                'choice_label' => 'id',
//            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary mt-3',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
