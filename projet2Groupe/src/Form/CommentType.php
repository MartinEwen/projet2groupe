<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
            ])
            ->add('tagUser', TextType::class, [
                'label' => 'Identifier un utilisateur'
            ])
            ->add('pictures', FileType::class, [
                'label' => 'Capture(s) d\'écran',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new All(
                        new File([
                            'maxSize' => '50000k',
                            'mimeTypes' => [
                                'image/*',
                            ],
                            'mimeTypesMessage' => 'Image trop lourde',
                        ])
                    )
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
