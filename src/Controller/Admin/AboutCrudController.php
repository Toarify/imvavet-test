<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Form\CKEditorType as FormCKEditorType;
use App\Form\TinyMCEType;
use App\Form\Type\CKEditorType;
use Ehyiah\QuillJsBundle\DTO\QuillGroup;
use Ehyiah\QuillJsBundle\Form\QuillAdminField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return About::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // QuillAdminField::new('presentation')
            // ->setFormTypeOptions([
            // 'quill_options' =>
            //     QuillGroup::buildWithAllFields(),
            //     'quill_extra_options' => [
            //         'placeholder' => ''
            //     ]
            // ]),

            TextareaField::new('presentation')  // <- Utilisez TextareaField au lieu de TextField
            ->setFormType(TinyMCEType::class)
            ->setLabel('Presentation de l\'institut:')
            ->hideOnIndex(), // Optionnel: cache sur la liste,

            TextareaField::new('leaderWord')  // <- Utilisez TextareaField au lieu de TextField
            ->setFormType(TinyMCEType::class)
            ->setLabel('Mot du directeur:')
            ->hideOnIndex(),
        ];
    }
    
}
