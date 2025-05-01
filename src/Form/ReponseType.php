<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Reponse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenuReponse')
            ->add('dateReponse', null, [
                'widget' => 'single_text',
            ])
            ->add('idCommentaire', EntityType::class, [
                'class' => Commentaire::class,
                'choice_label' => 'contenu', // Use 'contenu' or another meaningful field
                // Optionally, you can create a custom label using a callback
                // 'choice_label' => fn(Commentaire $commentaire) => $commentaire->getIdCommentaire() . ' - ' . $commentaire->getContenu(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}