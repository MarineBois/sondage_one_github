<?php

namespace SO\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="SO\PlatformBundle\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;

    /**
     * @var string
     *
     * @ORM\Column(name="personne", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $personne;

    /**
    * @ORM\ManyToOne(targetEntity="SO\PlatformBundle\Entity\Proposition", inversedBy="reponses")
    * @ORM\JoinColumn(nullable=false)
    */
    private $proposition;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set personne
     *
     * @param string $personne
     *
     * @return Reponse
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return string
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set proposition
     *
     * @param \SO\PlatformBundle\Entity\Proposition $proposition
     *
     * @return Reponse
     */
    public function setProposition(\SO\PlatformBundle\Entity\Proposition $proposition)
    {
        $this->proposition = $proposition;

        return $this;
    }

    /**
     * Get proposition
     *
     * @return \SO\PlatformBundle\Entity\Proposition
     */
    public function getProposition()
    {
        return $this->proposition;
    }
}
