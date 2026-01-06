<?php 
//error_reporting(0);
$filePath = $_SERVER['DOCUMENT_ROOT']."/afia";
include("../conf/db_connection.php");
$vendor_id = $_GET['vendor_id'];

	
$sql = "SELECT `tbl_locations`.`street` AS street, CONCAT_WS(' ', `tbl_schedule_calendar`.`cal_title`, `tbl_locations`.`street`) AS title, `tbl_locations`.`district_id`,  DATE(`tbl_schedule_calendar`.`start_date`) AS start, DATE(`tbl_schedule_calendar`.`end_date`) AS end FROM `tbl_schedule_calendar`, `tbl_locations` WHERE `tbl_schedule_calendar`.`location_id` = `tbl_locations`.`district_id` AND `tbl_schedule_calendar`.`vendor_id`=$vendor_id";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    // Fetch data and store it in the $events array
    while($row = $result->fetch_assoc()) {
        //$events[] = $row;
		$tDate = $row['start'];
		$DayOfWeek = date("w", strtotime($tDate));
		
		$title = $row['title'];
$titleLower = mb_strtolower($title, 'UTF-8');
$firstLetter = mb_strtoupper(mb_substr($titleLower, 0, 1, 'UTF-8'), 'UTF-8');
$restOfString = mb_substr($titleLower, 1, null, 'UTF-8');
$capitalizedTitle = $firstLetter . $restOfString;

        $events[] = array(
			'id' => $row['district_id'],
			'street' => $row['street'],
            'title' => mb_convert_case($capitalizedTitle, MB_CASE_TITLE, "UTF-8"),
            'daysOfWeek' => $DayOfWeek,
            'start' => $row['start'],
			'end' => $row['end']
        );
    }
}

$conn->close(); // Close the database connection

header('Content-Type: application/json');
echo json_encode($events); // Encode and output the JSON

?>