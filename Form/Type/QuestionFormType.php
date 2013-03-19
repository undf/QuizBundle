<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
namespace Egulias\QuizBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Egulias\QuizBundle\Model\Questions\Question
;

class QuestionFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'required' => TRUE,
                'trim'     => TRUE
            ))
            ->add('text', 'text', array(
                'required' => TRUE,
                'trim'     => TRUE
            ))
            ->add('type', 'choice', array(
                'choices' => Question::getBaseTypes(),
                'trim' => TRUE,
                'required' => TRUE
            ))
            ->add('choices', new ChoicesFormType())
            ;
    }

    public function getName()
    {
        return 'question';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Egulias\QuizBundle\Entity\Question'
        );
    }

}
