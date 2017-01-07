<?php

namespace booksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Search
 *
 * @ORM\Table(name="search")
 * @ORM\Entity(repositoryClass="booksBundle\Repository\SearchRepository")
 */
class Search
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
     * @ORM\Column(name="searchField", type="string", length=255)
     */
    private $searchField;

    /**
     * @var string
     *
     * @ORM\Column(name="categories", type="string", length=255)
     */
    private $categories;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;


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
     * Set searchField
     *
     * @param string $searchField
     *
     * @return Search
     */
    public function setSearchField($searchField)
    {
        $this->searchField = $searchField;

        return $this;
    }

    /**
     * Get searchField
     *
     * @return string
     */
    public function getSearchField()
    {
        return $this->searchField;
    }

    /**
     * Set categories
     *
     * @param string $categories
     *
     * @return Search
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Search
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }
}

