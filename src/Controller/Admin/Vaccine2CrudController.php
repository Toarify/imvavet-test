<?php

namespace App\Controller\Admin;

use App\Entity\Vaccine2;
use App\Form\Type\TinyMCEType;
use App\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Vaccine2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vaccine2::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('type')  // <- Utilisez TextareaField au lieu de TextField
            ->setFormType(TinyMCEType::class)
            ->hideOnIndex(), // Optionnel: cache sur la liste,
        ];
    }
    
}
