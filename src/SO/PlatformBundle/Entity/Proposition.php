<?php

namespace SO\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//ce use permet de lancer le service validator par les annotations 
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Proposition
 *
 * @ORM\Table(name="proposition")
 * @ORM\Entity(repositoryClass="SO\PlatformBundle\Repository\PropositionRepository")
 */
class Proposition
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
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $titre;

    /**
    * @ORM\ManyToOne(targetEntity="SO\PlatformBundle\Entity\Sondage", inversedBy="propositions")
    * @ORM\JoinColumn(nullable=false)
    */
    private $sondage;

    /**
    * @ORM\OneToMany(targetEntity="SO\PlatformBundle\Entity\Reponse", mappedBy="proposition", cascade={"remove"})
    */
    private $reponses;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Proposition
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set sondage
     *
     * @param \SO\PlatformBundle\Entity\Sondage $sondage
     *
     * @return Proposition
     */
    public function setSondage(\SO\PlatformBundle\Entity\Sondage $sondage)
    {
        $this->sondage = $sondage;

        return $this;
    }

    /**
     * Get sondage
     *
     * @return \SO\PlatformBundle\Entity\Sondage
     */
    public function getSondage()
    {
        return $this->sondage;
    }

    /**
     * Add reponse
     *
     * @param \SO\PlatformBundle\Entity\Reponse $reponse
     *
     * @return Proposition
     */
    public function addReponse(\SO\PlatformBundle\Entity\Reponse $reponse)
    {
        $this->reponses[] = $reponse;

        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \SO\PlatformBundle\Entity\Reponse $reponse
     */
    public function removeReponse(\SO\PlatformBundle\Entity\Reponse $reponse)
    {
        $this->reponses->removeElement($reponse);
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponses()
    {
        return $this->reponses;
    }
}
