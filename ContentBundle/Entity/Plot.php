<?php

namespace ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;


/**
 * @ORM\Table(name="Plot", indexes={
 *    @ORM\Index(columns={"address"}, flags={"fulltext"})
 * })
 * @ORM\Entity(repositoryClass="ContentBundle\Entity\Repo\PlotRepository")
 */
class Plot
{

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=250)
	 */
	private $cadastralNumber;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=512)
	 */
	private $address;

	/**
	 *
	 * @var float
	 * @ORM\Column(type="decimal", precision=8, scale=2)
	 */
	private $price;

	/**
	 *
	 * @var float
	 * @ORM\Column(type="decimal", precision=8, scale=2)
	 */
	private $area;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getCadastralNumber()
	{
		return $this->cadastralNumber;
	}

	/**
	 * @param string $cadastralNumber
	 */
	public function setCadastralNumber($cadastralNumber)
	{
		$this->cadastralNumber = $cadastralNumber;
	}

	/**
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param string $address
	 */
	public function setAddress($address)
	{
		$this->address = $address;
	}

	/**
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param float $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * @return float
	 */
	public function getArea()
	{
		return $this->area;
	}

	/**
	 * @param float $area
	 */
	public function setArea($area)
	{
		$this->area = $area;
	}

}
