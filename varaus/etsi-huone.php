<?php
include_once("../php/db-cred.php");

function ConnectToDB($databaseName)
{
    $conn = new mysqli(SERVER, USERNAME, PASSWORD, $databaseName);
    if ($conn->connect_error) {
        die("connection failed! " . $conn->connect_error);
    }
    return $conn;
}

function GetRooms($hotel, $size)
{
    // connect to DB
    $searchDB = ConnectToDB("p_hotelli_test");

    $stmt = $searchDB->prepare('SELECT * FROM huoneet WHERE hotelli_ID = ? AND vuodepaikat >= ?');
    $stmt->bind_param('ii', $hotel, $size);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows <= 0) exit(json_encode("vittu"));

    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }

    // disconnect from DB
    $searchDB->close();

    return $rooms;
}

function GetBookedRooms($hotel, $size, $startDate, $endDate)
{
    // connect to DB
    $searchDB = ConnectToDB("p_hotelli_test");

    // search DB with $searchData
    $bookedRoomsQuery = $searchDB->prepare('SELECT *
                            FROM huoneidenvaraukset
                            INNER JOIN huoneet
                            ON huoneidenvaraukset.huone_ID = huoneet.huone_ID
                            WHERE 
                            hotelli_ID = ? AND vuodepaikat >= ? AND ? BETWEEN alku_pvm AND loppu_pvm 
                            OR
	                        hotelli_ID = ? AND vuodepaikat >= ? AND ? BETWEEN alku_pvm AND loppu_pvm;');

    $bookedRoomsQuery->bind_param('iisiis', $hotel, $size, $startDate, $hotel, $size, $endDate);
    $bookedRoomsQuery->execute();

    $result = $bookedRoomsQuery->get_result();

    if ($result->num_rows <= 0) return null;

    // get available rooms to an array
    while ($row = $result->fetch_assoc()) {
        $bookedRooms[] = $row;
    }

    // disconnect from DB
    $searchDB->close();

    return $bookedRooms;
}

function filterBookedRooms($a, $b)
{
    $result = (array) null;
    foreach ($a as $e) {
        foreach ($b as $e2) {
            if ($e['huone_ID'] === $e2['huone_ID']) continue;
            else array_push($result, $e);
        }
    }
    return $result;
}

?>

<?php
// MAIN

// receive data from the front-end
$searchData = json_decode(file_get_contents("php://input"), true);

$hotel = $searchData['location'];
$size = $searchData['roomSize'];
$startDate = $searchData['startDate'];
$endDate = $searchData['endDate'];

$rooms = GetRooms((int)$hotel, (int)$size);

$booked = GetBookedRooms((int)$hotel, (int)$size, $startDate, $endDate);

if (!empty($booked)) $availableRooms = filterBookedRooms($rooms, $booked);
else
    $availableRooms = $rooms;

// send data back to the front-end
exit(json_encode($availableRooms));
?>