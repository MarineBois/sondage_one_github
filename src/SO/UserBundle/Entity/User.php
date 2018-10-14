<?php

namespace SO\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SO\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
    * @ORM\OneToMany(targetEntity="SO\PlatformBundle\Entity\Sondage", mappedBy="user")
    */
  protected $sondages;

  /**
     * Add sondage
     *
     * @param \SO\PlatformBundle\Entity\Sondage $sondage
     *
     * @return Utilisateur
     */
    public function addSondage(\SO\PlatformBundle\Entity\Sondage $sondage)
    {
        $this->sondages[] = $sondage;

        return $this;
    }

    /**
     * Remove sondage
     *
     * @param \SO\PlatformBundle\Entity\Sondage $sondage
     */
    public function removeSondage(\SO\PlatformBundle\Entity\Sondage $sondage)
    {
        $this->sondages->removeElement($sondage);
    }

    /**
     * Get sondages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSondages()
    {
        return $this->sondages;
    }

}
