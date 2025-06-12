<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use App\Form\TinyMCEType;
use App\Form\ArticleImageType;
use App\Form\ArticleSourceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Controller\Admin\ArticleDetailsCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Bundle\SecurityBundle\Security; // Changement important ici

class ArticleCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function persistEntity($entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Article) {
            $entityInstance->setCreatedBy($this->security->getUser());
        }
        
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity($entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Article) {
            $entityInstance->setUpdatedBy($this->security->getUser());
        }
        
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextareaField::new('name')
                ->setLabel('Titre:')
                ->setFormType(TinyMCEType::class)
                ->formatValue(function ($value, $entity) {
                    return $entity->getCleanName() ?? $value;
                }),

            TextareaField::new('firstAthor')
                ->setLabel('Auteurs:')
                ->setFormType(TinyMCEType::class)
                ->formatValue(function ($value, $entity) {
                    return $entity->getCleanFirstAuthor() ?? $value;
                }),

            CollectionField::new('articleImages')
                ->setLabel('Images relié au publication:')
                ->setEntryType(ArticleImageType::class),
            
            AssociationField::new('details')
                ->setCrudController(ArticleDetailsCrudController::class)
                ->hideOnForm(),
        
            CollectionField::new('articleSources')
                ->setLabel('Sources PDF:')
                ->setEntryType(ArticleSourceType::class)
                ->setEntryIsComplex(true)
                ->setRequired(false),

            TextField::new('url')
                ->setLabel('Lien du la publication'),

            
  
            
        ];

        // Ajout des champs utilisateur seulement pour les pages index et detail
        if (in_array($pageName, ['index', 'detail'])) {
            // $fields[] = TextField::new('createdBy', 'Créé par')
            //     ->formatValue(function ($value, $entity) {
            //         return $entity->getCreatedBy() ? (string)$entity->getCreatedBy()->getFirstname() : 'N\'est pas defini';
            //     })
            //     ->hideOnForm()
            //     ->setCustomOption('linkable', false); // Désactive le lien

            $fields[] = TextField::new('createdBy', 'Créé par')
            ->setVirtual(true)
            ->formatValue(function ($value, $entity) {
                $user = $entity->getCreatedBy();
                return $user ? $user->getFirstname() . ' ' . $user->getLastname() : 'Aucun(e)';
            });

            $fields[] = DateTimeField::new('createdAt')
                ->setLabel('Date de création')
                ->hideOnForm()
                ->setFormat('dd/MM/yyyy HH:mm:ss');
                
            // $fields[] = AssociationField::new('updatedBy', 'Modifié par')
            //     ->formatValue(function ($value, $entity) {
            //         return $entity->getUpdatedBy() ? $entity->getUpdatedBy()->getFirstname() : 'N\'est pas defini';
            //     })
            //     ->hideOnForm()
            //     ->setCustomOption('linkable', false); // Désactive le lien

            $fields[] = TextField::new('updatedBy', 'Modifié par')
    ->setVirtual(true)
    ->formatValue(function ($value, $entity) {
        $user = $entity->getUpdatedBy();
        return $user ? $user->getFirstname() . ' ' . $user->getLastname() : 'Aucun(e)';
    });

            $fields[] = DateTimeField::new('updatedAt')
                ->setLabel('Date de modification')
                ->hideOnForm()
                ->setFormat('dd/MM/yyyy HH:mm:ss');
        }

        return $fields;
    }
}