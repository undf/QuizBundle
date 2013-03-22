<?php

/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace Egulias\QuizBundle\Entity;

use Egulias\QuizBundle\Model\Quizes\Quiz as BaseQuiz,
    Doctrine\ORM\Mapping as ORM
;
use Doctrine\Common\Util\Debug;
use JMS\Serializer\Annotation as JMS;

/**
 *
 * @ORM\Entity
 * @ORM\Table (name="qz_quiz")
 * @JMS\ExclusionPolicy("all")
 */
class Quiz extends BaseQuiz
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @JMS\Groups({"list" })
     * @JMS\Expose
     * @ORM\OneToMany(targetEntity="QuizQuestion", mappedBy="quiz", cascade={"persist"})
     */
    protected $questions;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *  Get Quiz questions
     *
     *  @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
