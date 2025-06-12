<?php

namespace App\Form;

use App\Entity\ArticleImage;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $builder
        //     ->add('imageFile', VichFileType::class,['label'=>'image'])
        // ;

        $builder->add('imageFile', VichFileType::class, [
            'label' => 'Fichier Image',
            'allow_delete' => false,
            'download_uri' => false,
            'constraints' => [
                new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/jpg',
                        'image/png'
                    ],
                    'mimeTypesMessage' => 'Erreur : Seuls les fichiers JPG, JPEG ou PNG sont acceptés',
                ])
            ],
            'invalid_message' => 'Erreur : Seuls les fichiers JPG, JPEG ou PNG sont acceptés',
            'invalid_message_parameters' => [],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleImage::class
        ]);
    }
}
