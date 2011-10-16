<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
namespace Egulias\QuizBundle\Model\Questions;

use Egulias\QuizBundle\Model\Answers\Answer;
use Egulias\QuizBundle\Model\Questions\Option;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Declaration of class Question to allow the creation of multiple types of questions
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 */
abstract class Question
{
    const TEXT = 'text';
    const TEXTAREA = 'textarea';
    const NUMBER = 'number';
    const BOOLEAN = 'boolean';
    const CHOICE = 'choice';


    protected $name = '';
    protected $text = '';
    protected $answer = null;
    protected $form = null;


    abstract public function setText($text);
    abstract public function getText();
    abstract public function setType($type);
    abstract public function getType();

    abstract public function addAnswer(Answer $answer);
    abstract public function getAnswer();

    public function __construct()
    {
        $this->answer = new ArrayCollection();
    }

    public static function getBaseTypes()
    {
        $t = array(
            self::TEXT      => self::TEXT,
            self::TEXTAREA  => self::TEXTAREA,
            self::NUMBER    => self::NUMBER,
            self::BOOLEAN   => self::BOOLEAN,
            self::CHOICE    => self::CHOICE,
        );
        return $t;
    }

    /**
     *  Allows the Questions to have different options
     *  @param QuestionOption $qOption
     *  @return Question
     */
    public function addOption($qOption)
    {
    }

    public function __toString()
    {
        return $this->getName();
    }
}
