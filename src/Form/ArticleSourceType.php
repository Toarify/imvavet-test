<?php

namespace App\Form;

use App\Entity\ArticleSource;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleSourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('pdfFile', VichFileType::class, [
            'label' => 'Fichier source de la publication en PDF',
            'allow_delete' => false,
            'download_uri' => false,
            'constraints' => [
                new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'application/pdf', 
                        'application/x-pdf'
                    ],
                    'mimeTypesMessage' => 'Erreur : Seuls les fichiers PDF (.pdf) sont acceptés',
                ])
            ],
            'invalid_message' => 'Erreur : Seuls les fichiers PDF (.pdf) sont acceptés',
            'invalid_message_parameters' => [],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleSource::class,
        ]);
    }
}