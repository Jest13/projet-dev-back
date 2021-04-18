<?php
namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\MotsCles;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AjoutArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu', CKEditorType::class)
            ->add('imageFile', VichImageType ::class, [
                'label' => 'Image'
            ])
            ->add('mots_cles', EntityType::class,[
                'class' => MotsCles::class,
                'label' => 'Mots-Clés',
                'multiple' => true,
                'expanded' => true
            ])
            
            ->add('categories', Entitytype::class,[
                'class' => Categories::class,
                'label' => 'Categories',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('Publier', SubmitType::class)
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
