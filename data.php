<?php
	// Initialize the database connection
	require "config.php";

	/*
	Returns an associative array of employee/boss ID/name for a given page.
	A page is defined as 100 rows
	*/
	function getData($db) {
		try {
			$page = $_GET['page'];

			$stmt = $db->query('SELECT COUNT(*) c FROM employees');
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$total_records = $results[0]['c'];
			$total_pages = $total_records / 100;

			$ret = array("total" => $total_pages, "page" => $page, "records" => $total_records);

			$page_limit = ($page - 1) * 100;

			$query = "
			SELECT e1.id e_id, e1.name e_name, e2.id b_id, e2.name b_name
			FROM employees e1
			INNER JOIN employees e2 ON e2.id = e1.bossId
			LIMIT ?,100
			";

			$stmt = $db->prepare($query);
			$stmt->execute(array($page_limit));

			$ret['rows'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $ret;

		} catch (PDOException $e) {
			die("MySQL Error: " . $e->getMessage());
		}
	}

	/*
	Returns the distance from a given employee ID to CEO
	*/
	function getDistance($db, $employee_id) {
		return getParent($db, $employee_id, 0);
	}

	/*
	Returns the distance from a given employee ID to CEO
	*/
	function getParent($db, $id, $depth) {
		try {
			$query = "SELECT bossId FROM employees WHERE id = '$id' AND bossId != id LIMIT 1";			
			$stmt = $db->query($query);
			$val = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			if ($count > 0) {
				$depth = $depth + 1;
				return getParent($db, $val[0]['bossId'], $depth);
			} else {
				return $depth;
			}
		} catch (PDOException $e) {
			die("MySQL Error: " . $e->getMessage());
		}
	}

	/*
	Returns the number of subordinants of a given employee
	*/
	function getSubordinants($db, $employee_id) {
		// TBD
	}

	/*
	Prints data in a simple HTML table
	*/
	function printData($data) {
		try {
			echo "<table>";
			foreach ($data['rows'] as $i => $arr) {
				if ($i == 0) {
					echo "<tr>";
					foreach ($arr as $k => $v) {
						echo "<th>$k</th>";
					}
					echo "</tr>";
				}
				echo "<tr>";
				foreach ($arr as $k => $v) {
					echo "<td>$v</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		} catch (Exception $e) {
		}
	}

	/*
	Prints data in JSON format
	*/
	function printDataJSON($data) {
		try {
			return json_encode($data);
		} catch (Exception $e) {
			return "Error: " . $e->getMessage();
		}
	}

	$data = getData($db);
	foreach($data['rows'] as $k => $v) {
		$data['rows'][$k]['depth'] = getDistance($db, $v["e_id"]);
	}
	echo printDataJSON($data);

?>