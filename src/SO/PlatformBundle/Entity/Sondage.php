<?php

namespace SO\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Sondage
 *
 * @ORM\Table(name="sondage")
 * @ORM\Entity(repositoryClass="SO\PlatformBundle\Repository\SondageRepository")
 */
class Sondage
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
     * @Assert\Length(min=10)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="text")
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="SO\UserBundle\Entity\User", inversedBy="sondages")
    * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    /**
    * @ORM\OneToMany(targetEntity="SO\PlatformBundle\Entity\Commentaire", mappedBy="sondage", cascade={"remove"})
    */
    private $commentaires;

    /**
    * @ORM\OneToMany(targetEntity="SO\PlatformBundle\Entity\Proposition", mappedBy="sondage", cascade={"remove"})
    */
    private $propositions;

    public function __construct()
    {
        $this->date = new \Datetime();
    }

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
     * @return Sondage
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Sondage
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Sondage
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Add commentaire
     *
     * @param \SO\PlatformBundle\Entity\Commentaire $commentaire
     *
     * @return Sondage
     */
    public function addCommentaire(\SO\PlatformBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \SO\PlatformBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\SO\PlatformBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add proposition
     *
     * @param \SO\PlatformBundle\Entity\Proposition $proposition
     *
     * @return Sondage
     */
    public function addProposition(\SO\PlatformBundle\Entity\Proposition $proposition)
    {
        $this->propositions[] = $proposition;

        return $this;
    }

    /**
     * Remove proposition
     *
     * @param \SO\PlatformBundle\Entity\Proposition $proposition
     */
    public function removeProposition(\SO\PlatformBundle\Entity\Proposition $proposition)
    {
        $this->propositions->removeElement($proposition);
    }

    /**
     * Get propositions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropositions()
    {
        return $this->propositions;
    }

    /**
     * Set user
     *
     * @param \SO\UserBundle\Entity\User $user
     *
     * @return Sondage
     */
    public function setUser(\SO\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SO\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
