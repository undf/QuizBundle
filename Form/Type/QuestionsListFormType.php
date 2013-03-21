<?php

/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace Egulias\QuizBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Egulias\QuizBundle\Form\EventListener\AddQuizFieldSubscriber,
    Doctrine\ORM\EntityRepository

;

class QuestionsListFormType extends AbstractType
{

    protected $builder = null;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->builder = $builder;

        $builder
                ->add('question', 'entity', array(
                    'required' => true,
                    'class' => 'EguliasQuizBundle:Question')
                )
                ->add('quiz', 'entity', array(
                    'class' => 'EguliasQuizBundle:Quiz',
                    'read_only' => true)
                )
                ->add('delete', 'checkbox', array(
                    'required' => false,
                    'property_path' => false)
                );
    }

    public function getName()
    {
        return 'question';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Egulias\QuizBundle\Entity\QuizQuestion',
            'csrf_protection' => FALSE
        );
    }

}
