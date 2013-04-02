<?php

namespace Egulias\QuizBundle\Form\Manager;

use Symfony\Component\HttpFoundation\Request;
use Egulias\QuizBundle\Form\Type\GenericQuizFormType as QuizForm;
use Egulias\QuizBundle\Entity\Answer;
use FOS\UserBundle\Model\User;

/**
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 * @package EguliasQuizBundle
 * @subpackage Form
 */
class TakeQuizFormManager
{

    protected $em = NULL;
    protected $request = NULL;
    protected $formFactory = NULL;

    public function __construct(Request $request, $em, $formFactory)
    {
        $this->em = $em;
        $this->request = $request;
        $this->formFactory = $formFactory;
    }

    /**
     * Obtain a Quiz form with questions and answer fields
     *
     * @param int $id Quiz Id
     * @return Egulias\QuizBundle\Form\Type\GenericQuizFormType
     * @throw \InvalidArgumentException
     */
    public function takeQuiz($id)
    {
        $id = intval($id);
        try {
            $quiz = $this->getQuiz($id);
            $questions = $quiz->getQuestions();
            foreach ($questions as $question) {
                $question->setAnswer(new Answer());
            }

            $form = $this->formFactory->create(new QuizForm(), $quiz);
            return $form;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 0, $e);
        }
    }

    /**
     * Saves Quiz responses
     *
     * @param int $id
     * @return Egulias\QuizBundle\Form\Type\GenericQuizFormType $form
     * @throw \Exception
     */
    public function responseQuiz($id, $uuid)
    {
        try {
            $quiz = $this->getQuiz($id);
            $quiz->setUUID($uuid);

            $form = $this->takeQuiz($id);
            $form->bindRequest($this->request);
            $qQuestions = $form->getData()->getQuestions();
            foreach ($qQuestions as $qq) {
                $formAnswer = $qq->getAnswer();

                $quizQuestion = $this->em->getRepository('EguliasQuizBundle:QuizQuestion')
                        ->findOneBy(array('id' => $qq->getId()));

                $q = $quizQuestion->getQuestion();
                $type = $q->getType();
                if ($type == 'choice') {
                    $choices = $q->getChoices();
                    if ($choices->getType() == 'radio') {
                        //Compatible with PHP 5.3.x
                        $choices = $choices->getChoices();
                        $formAnswer->setResponse(
                                array(
                                    $formAnswer->getResponse() => $choices[$formAnswer->getResponse()]
                                )
                        );
                    }
                }
                $formAnswer->setQuizUuid($uuid);
                $formAnswer->setQuizQuestion($quizQuestion);
                $this->em->persist($formAnswer);
            }
            $this->em->flush();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 0, $e);
        }
        return $form;
    }

    /**
     *
     * @param type $id
     * @return Egulias\QuizBundle\Model\Quizes\Quiz
     * @throws \InvalidArgumentException
     */
    public function getQuiz($id)
    {
        if (!$quiz = $this->em->getRepository('EguliasQuizBundle:Quiz')->findOneBy(array('id' => $id))) {
            throw new \InvalidArgumentException("Invalid Quiz ID. Value given $id ");
        }

        return $quiz;
    }

}
