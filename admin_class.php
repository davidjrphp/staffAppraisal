<?php
session_start();
ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		extract($_POST);
		$type = array("employee_list", "supervisor_list", "users");
		$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM {$type[$login]} where email = '" . $email . "' and password = '" . md5($password) . "'  ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			$_SESSION['login_type'] = $login;
			return 1;
		} else {
			return 2;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '" . $student_code . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['rs_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function save_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!empty($password)) {
			$data .= ", password=md5('$password') ";
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";
		}
		if (empty($id)) {
			if (!isset($_FILES['img']) || (isset($_FILES['img']) && $_FILES['img']['tmp_name'] == '')) {
				$data .= ", avatar = 'no-image-available.png' ";
			}
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function signup()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass')) && !is_numeric($k)) {
				if ($k == 'password') {
					if (empty($v))
						continue;
					$v = md5($v);
				}
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";
		}
		if (empty($id)) {
			if (!isset($_FILES['img']) || (isset($_FILES['img']) && $_FILES['img']['tmp_name'] == '')) {
				$data .= ", avatar = 'no-image-available.png' ";
			}
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			if (empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if (!in_array($key, array('id', 'cpass', 'password')) && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			$_SESSION['login_id'] = $id;
			if (isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
				$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}

	function update_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'table', 'password')) && !is_numeric($k)) {

				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$type = array("employee_list", "supervisor_list", "users");
		$check = $this->db->query("SELECT * FROM {$type[$_SESSION['login_type']]} where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";
		}
		if (!empty($password))
			$data .= " ,password=md5('$password') ";
		if (empty($id)) {
			if (!isset($_FILES['img']) || (isset($_FILES['img']) && $_FILES['img']['tmp_name'] == '')) {
				$data .= ", avatar = 'no-image-available.png' ";
			}
			$save = $this->db->query("INSERT INTO {$type[$_SESSION['login_type']]} set $data");
		} else {
			$save = $this->db->query("UPDATE {$type[$_SESSION['login_type']]} set $data where id = $id");
		}

		if ($save) {
			foreach ($_POST as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			if (isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
				$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_system_settings()
	{
		extract($_POST);
		$data = '';
		foreach ($_POST as $k => $v) {
			if (!is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if ($_FILES['cover']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'], '../assets/uploads/' . $fname);
			$data .= ", cover_img = '$fname' ";
		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE system_settings set $data where id =" . $chk->fetch_array()['id']);
		} else {
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if ($save) {
			foreach ($_POST as $k => $v) {
				if (!is_numeric($k)) {
					$_SESSION['system'][$k] = $v;
				}
			}
			if ($_FILES['cover']['tmp_name'] != '') {
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image()
	{
		extract($_FILES['file']);
		if (!empty($tmp_name)) {
			$fname = strtotime(date("Y-m-d H:i")) . "_" . (str_replace(" ", "-", $name));
			$move = move_uploaded_file($tmp_name, 'assets/uploads/' . $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path = explode('/', $_SERVER['PHP_SELF']);
			$currentPath = '/' . $path[1];
			if ($move) {
				return $protocol . '://' . $hostName . $currentPath . '/assets/uploads/' . $fname;
			}
		}
	}
	function save_department()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'user_ids')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM department_list where department = '$department' and id != '{$id}' ")->num_rows;
		if ($chk > 0) {
			return 2;
		}
		if (isset($user_ids)) {
			$data .= ", user_ids='" . implode(',', $user_ids) . "' ";
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO department_list set $data");
		} else {
			$save = $this->db->query("UPDATE department_list set $data where id = $id");
		}
		if ($save) {
			return 1;
		}
	}
	function delete_department()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM department_list where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function save_designation()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'user_ids')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$chk = $this->db->query("SELECT * FROM job_description where j_title = '$j_title' and id != '{$id}' ")->num_rows;
		if ($chk > 0) {
			return 2;
		}
		if (isset($user_ids)) {
			$data .= ", user_ids='" . implode(',', $user_ids) . "' ";
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO job_description set $data");
		} else {
			$save = $this->db->query("UPDATE job_description set $data where id = $id");
		}
		if ($save) {
			return 1;
		}
	}
	function delete_designation()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM job_decsription where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function save_employee()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!empty($password)) {
			$data .= ", password=md5('$password') ";
		}
		$check = $this->db->query("SELECT * FROM employee_list where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";
		}
		if (empty($id)) {
			if (!isset($_FILES['img']) || (isset($_FILES['img']) && $_FILES['img']['tmp_name'] == '')) {
				$data .= ", avatar = 'no-image-available.png' ";
			}
			$save = $this->db->query("INSERT INTO employee_list set $data");
		} else {
			$save = $this->db->query("UPDATE employee_list set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function delete_employee()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM employee_list where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_supervisor()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!empty($password)) {
			$data .= ", password=md5('$password') ";
		}
		$check = $this->db->query("SELECT * FROM supervisor_list where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";
		}
		if (empty($id)) {
			if (!isset($_FILES['img']) || (isset($_FILES['img']) && $_FILES['img']['tmp_name'] == '')) {
				$data .= ", avatar = 'no-image-available.png' ";
			}
			$save = $this->db->query("INSERT INTO supervisor_list set $data");
		} else {
			$save = $this->db->query("UPDATE supervisor_list set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function delete_supervisor()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM supervisor_list where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_task()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if ($k == 'description')
					$v = htmlentities(str_replace("'", "&#x2019;", $v));
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO task_list set $data");
		} else {
			$save = $this->db->query("UPDATE task_list set $data where id = $id");
		}
		if ($save) {
			return 1;
		}
	}
	function delete_task()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM task_list where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function save_work_plan()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if ($k == 'targets')
					$v = htmlentities(str_replace("'", "&#x2019;", $v));
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO work_plan set $data");
		} else {
			$save = $this->db->query("UPDATE work_plan set $data where id = $id");
		}
		if ($save) {
			return 1;
		}
	}
	function delete_work_plan()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM work_plan where id = $id");
		if ($delete) {
			return 1;
		}
	}

	function save_progress()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if ($k == 'progress')
					$v = htmlentities(str_replace("'", "&#x2019;", $v));
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!isset($is_complete))
			$data .= ", is_complete=0 ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO task_progress set $data");
		} else {
			$save = $this->db->query("UPDATE task_progress set $data where id = $id");
		}
		if ($save) {
			if (!isset($is_complete))
				$this->db->query("UPDATE task_list set status = 1 where id = $task_id ");
			else
				$this->db->query("UPDATE task_list set status = 2 where id = $task_id ");
			return 1;
		}
	}
	function delete_progress()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM task_progress where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function save_evaluation()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$data .= ", supervisor_id = {$_SESSION['login_id']} ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO ratings set $data");
		} else {
			$save = $this->db->query("UPDATE ratings set $data where id = $id");
		}
		if ($save) {
			if (!isset($is_complete))
				return 1;
		}
	}
	function delete_evaluation()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM ratings where id = $id");
		if ($delete) {
			return 1;
		}
	}
	function get_emp_tasks()
	{
		extract($_POST);
		if (!isset($task_id))
			$get = $this->db->query("SELECT * FROM task_list where employee_id = $employee_id and status = 2 and id not in (SELECT task_id FROM ratings) ");
		else
			$get = $this->db->query("SELECT * FROM task_list where employee_id = $employee_id and status = 2 and id not in (SELECT task_id FROM ratings where task_id !='$task_id') ");
		$data = array();
		while ($row = $get->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	function get_progress()
	{
		extract($_POST);
		$get = $this->db->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as uname,u.avatar FROM task_progress p inner join task_list t on t.id = p.task_id inner join employee_list u on u.id = t.employee_id where p.task_id = $task_id order by unix_timestamp(p.date_created) desc ");
		$data = array();
		while ($row = $get->fetch_assoc()) {
			$row['uname'] = ucwords($row['uname']);
			$row['progress'] = html_entity_decode($row['progress']);
			$row['date_created'] = date("M d, Y", strtotime($row['date_created']));
			$data[] = $row;
		}
		return json_encode($data);
	}
	function get_report()
	{
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT t.*,p.name as ticket_for FROM ticket_list t inner join pricing p on p.id = t.pricing_id where date(t.date_created) between '$date_from' and '$date_to' order by unix_timestamp(t.date_created) desc ");
		while ($row = $get->fetch_assoc()) {
			$row['date_created'] = date("M d, Y", strtotime($row['date_created']));
			$row['name'] = ucwords($row['name']);
			$row['adult_price'] = number_format($row['adult_price'], 2);
			$row['child_price'] = number_format($row['child_price'], 2);
			$row['amount'] = number_format($row['amount'], 2);
			$data[] = $row;
		}
		return json_encode($data);
	}
	function upload_file()
	{
		extract($_FILES['file']);
		// var_dump($_FILES);
		if ($tmp_name != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $name;
			$move = move_uploaded_file($tmp_name, 'assets/uploads/' . $fname);
		}
		if (isset($move) && $move) {
			return json_encode(array("status" => 1, "fname" => $fname));
		}
	}
	function remove_file()
	{
		extract($_POST);
		if (is_file('assets/uploads/' . $fname))
			unlink('assets/uploads/' . $fname);
		return 1;
	}
	function delete_file()
	{
		extract($_POST);
		$doc = $this->db->query("SELECT * FROM document_list where id= $id")->fetch_array();
		$delete = $this->db->query("DELETE FROM document_list where id = " . $id);
		if ($delete) {
			foreach (json_decode($doc['file_json']) as $k => $v) {
				if (is_file('assets/uploads/' . $v))
					unlink('assets/uploads/' . $v);
			}
			return 1;
		}
	}
	function save_upload()
	{
		extract($_POST);
		// var_dump($_FILES);
		$data = " doc_title ='$doc_title' ";
		$data .= ", description ='" . htmlentities(str_replace("'", "&#x2019;", $description)) . "' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
		$data .= ", file_json ='" . json_encode($fname) . "' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO document_list set $data ");
		} else {
			$save = $this->db->query("UPDATE document_list set $data where id = $id");
		}
		if ($save) {
			return 1;
		}
	}
	function save_system()
	{
		extract($_POST);

		// Validate and sanitize the input data
		$name = $this->db->real_escape_string($name);
		$short_name = $this->db->real_escape_string($short_name);
		$about = $this->db->real_escape_string($content['about']);

		// Check if the system settings already exist
		$check = $this->db->query("SELECT * FROM system_settings")->num_rows;
		if ($check > 0) {
			// Update the existing system settings
			$update = $this->db->query("UPDATE system_settings SET name='$name', short_form='$short_name', about='$about'");
			if (!$update) {
				return 2; // Error in updating system settings
			}
		} else {
			// Insert new system settings
			$insert = $this->db->query("INSERT INTO system_settings (name, short_form, about) VALUES ('$name', '$short_name', '$about')");
			if (!$insert) {
				return 2; // Error in inserting system settings
			}
		}

		// Handle the file uploads for system logo and web cover
		if (isset($_FILES['img'])) {
			$avatar = $_FILES['img']['name'];
			$tmp_name = $_FILES['img']['tmp_name'];
			if (!empty($avatar)) {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $avatar;
				$move = move_uploaded_file($tmp_name, 'assets/uploads/' . $fname);
				if (!$move) {
					return 3; // Error in uploading file
				}
				// Update the system settings with the new file name
				$update = $this->db->query("UPDATE system_settings SET cover_img='$fname'");
				if (!$update) {
					return 2; // Error in updating system settings
				}
			}
		}

		return 1; // Success
	}
}
