<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
namespace Egulias\QuizBundle\Entity;

use Egulias\QuizBundle\Model\Quizes\QuizQuestion as QuizQuestionBase;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;


/**
 *
 * @ORM\Entity
 * @ORM\Table (name="qz_quiz_question")
 */
class QuizQuestion extends QuizQuestionBase
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"list" })
     * @JMS\Expose
     */
    protected $id;

 }
