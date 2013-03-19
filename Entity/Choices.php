<?php

/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace Egulias\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Egulias\QuizBundle\Model\Questions\QuestionChoices;

/**
 *
 * @ORM\Entity
 * @ORM\Table (name="qz_choices")
 */
class Choices extends QuestionChoices
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getChoicesForValues(array $values)
    {

    }

    public function getIndicesForChoices(array $choices)
    {

    }

    public function getIndicesForValues(array $values)
    {

    }

    public function getPreferredViews()
    {

    }

    public function getRemainingViews()
    {

    }

    public function getValues()
    {

    }

    public function getValuesForChoices(array $choices)
    {

    }

}
