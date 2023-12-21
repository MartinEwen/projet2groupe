<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextType::class, [
                'label' => 'Déscription'
            ])
            ->add('language', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'name',
                'required' => true,
                'multiple' => true,
                'expanded' => true,])
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
            'data_class' => Ticket::class,
        ]);
    }
}
