<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;

abstract class DAO
{
	/**
	 * Database Connection.
	 * @var \Doctrine\DBAL\Connection
	 */
	private $db;

	/**
	 * Constructor
	 * @param \Doctrine\DBAL\Connection The database connection objet
	 */
	public function __construct(Connection $db){
		$this->db = $db;
	}

	/**
	 * Grants access to the database connection object.
	 * @return \Doctrine\DBAL\Connection The database connection objet
	 */
	public function getDb(){
		return $this->db;
	}

	/**
	 * Build a domain object form a DB row
	 * Must be overriden by child classes.
	 */
	protected abstract function buildDomainObject(array $row);
}