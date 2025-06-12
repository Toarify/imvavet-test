<?php

namespace App\Form;

use App\Entity\VaccineImage;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class VaccineImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            	->add('imageFile', VichFileType::class, [
                'label' => 'Image',
                // 'attr' => [
                //     'data-browse' => 'Choisir un fichier', // Modifier le texte du bouton
                //     'class' => 'custom-file-input', // Ajouter une classe si besoin
                // ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VaccineImage::class
        ]);
    }
}
