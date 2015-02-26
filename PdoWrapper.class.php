<?php
	/**
	 * PHP PDO Wrapper Class.
	 *
	 * @author		k725
	 * @since		2014/11/12
	 * @version		0.2
	 * @copyright	Copyright (c) 2014, k725.
	 */
	class PDOWrapper
	{
		protected $dbh;
		protected $stmt;

		/**
		 * __construct
		 *
		 * @author	k725
		 * @access	public
		 * @param	string	$dbHost	MySQL host name
		 * @param	string	$dbName	MySQL database name
		 * @param	string	$dbChar	MySQL charset
		 * @param	string	$dbUser	MySQL user name
		 * @param	string	$dbPass	MySQL password
		 * @return	void
		 */
		public function __construct($dbHost, $dbName, $dbChar, $dbUser, $dbPass)
		{
			try
			{
				$this->dbh = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.';charset='.$dbChar, $dbUser, $dbPass);
			}
			catch (PDOException $e)
			{
				var_dump($e->getMessage());
				exit;
			}
		}

		/**
		 * __destruct
		 *
		 * @author	k725
		 * @access	public
		 * @return	void
		 */
		public function __destruct()
		{
			$this->closeDataBase();
		}

		/**
		 * closeDataBase
		 *
		 * @author	k725
		 * @access	public
		 * @return	void
		 */
		public function closeDataBase()
		{
			$this->dbh = null;
		}

		/**
		 * closeStmt
		 *
		 * @author	k725
		 * @access	public
		 * @return	void
		 */
		public function closeStmt()
		{
			$this->stmt->closeCursor();
			$this->stmt = null;
		}

		/**
		 * closeDataBase
		 *
		 * @author	k725
		 * @access	public
		 * @param	string	$sql	SQL query
		 * @param	array	$params	SQL option
		 * @return	integer			Last insert id
		 */
		public function runSql($sql, $params=null)
		{
			try
			{
				$this->stmt = $this->dbh->prepare($sql);

				if (empty($params))
				{
					$result = $this->stmt->execute();
				}
				else
				{
					foreach ($params as $value => $key) {
						$this->stmt->bindValue($value, $key[0], $key[1]);
					}

					$result = $this->stmt->execute();
				}

				if ($result == false)
				{
					throw new Exception('SQL run fail. ('.$sql.')');
				}

				return $this->dbh->lastInsertId();
			}
			catch (PDOException $e)
			{
				var_dump($e->getMessage());
				return null;
				exit;
			}
		}

		/**
		 * getData
		 *
		 * @author	k725
		 * @access	public
		 * @param	string	$sql	SQL query
		 * @param	array	$params	SQL option
		 * @return	array			Result multidimensional array (Associative array)
		 */
		public function getData($sql, $params=null)
		{
			$this->runSql($sql, $params);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * getTopData
		 *
		 * @author	k725
		 * @access	public
		 * @param	string	$sql	SQL query
		 * @param	array	$params	SQL option
		 * @return	array			Result array (Associative array)
		 */
		public function getTopData($sql, $params=null)
		{
			$this->runSql($sql, $params);
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
	}
