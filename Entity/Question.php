<?php
namespace Egulias\QuizBundle\Entity;

use
    Egulias\QuizBundle\Model\Questions\Question as BaseQuestion,
    Doctrine\ORM\Mapping as ORM
;
use JMS\Serializer\Annotation as JMS;
/**
 *
 * @ORM\Entity
 * @ORM\Table (name="qz_question")
 */
class Question extends BaseQuestion
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"list" })
     * @JMS\Expose
     * 
     */
    protected $id;

}
