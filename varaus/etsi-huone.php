<?php
include_once("../php/db-cred.php");

function connect_to_db($databaseName)
{
    $conn = new mysqli(SERVER, USERNAME, PASSWORD, $databaseName);
    if ($conn->connect_error) {
        die("connection failed! " . $conn->connect_error);
    }

    return $conn;
}

function get_available_rooms($hotel, $size, $startDate, $endDate)
{
    // connect to DB
    $db = connect_to_db("p_hotelli_test");

    // query DB
    $stmt = $db->prepare('SELECT * FROM huoneet 
                        WHERE hotelli_ID = ? AND vuodepaikat >= ?
                        AND huone_ID NOT IN (SELECT huone_ID FROM huoneidenvaraukset 
                        WHERE 
                        ? BETWEEN alku_pvm AND loppu_pvm
                        OR
                        ? BETWEEN alku_pvm AND loppu_pvm
                        OR
                        ? < alku_pvm and ? > loppu_pvm);');
    $stmt->bind_param('iissss', $hotel, $size, $startDate, $endDate, $startDate, $endDate);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows <= 0) return null;

    while ($row = $result->fetch_assoc()) {
        $availableRooms[] = $row;
    }

    // disconnect from DB
    $db->close();

    // return query results
    return $availableRooms;
}

// DEPRECATE
/* function get_all_rooms($hotel, $size)
{
    // connect to DB
    $searchDB = connect_to_db("p_hotelli_test");

    $stmt = $searchDB->prepare('SELECT * FROM huoneet WHERE hotelli_ID = ? AND vuodepaikat >= ?');
    $stmt->bind_param('ii', $hotel, $size);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows <= 0) return null;

    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }

    // disconnect from DB
    $searchDB->close();

    return $rooms;
}

function get_booked_rooms($hotel, $size, $startDate, $endDate)
{
    // connect to DB
    $searchDB = connect_to_db("p_hotelli_test");

    // search DB with $searchData
    $bookedRoomsQuery = $searchDB->prepare('SELECT *
                            FROM huoneidenvaraukset
                            INNER JOIN huoneet
                            ON huoneidenvaraukset.huone_ID = huoneet.huone_ID
                            WHERE 
                            hotelli_ID = ? AND vuodepaikat >= ? AND ? BETWEEN alku_pvm AND loppu_pvm 
                            OR
                            hotelli_ID = ? AND vuodepaikat >= ? AND ? BETWEEN alku_pvm AND loppu_pvm
                            OR
                            hotelli_ID = ? AND vuodepaikat >= ? AND ? < alku_pvm AND ? > loppu_pvm;');

    $bookedRoomsQuery->bind_param('iisiisiiss', $hotel, $size, $startDate, $hotel, $size, $endDate, $hotel, $size, $startDate, $endDate);
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

function filter_booked_rooms($a, $b)
{
    // optimize later

    $result = (array)null;
    $idsToRemove = (array)null;
    foreach ($b as $booked) {
        array_push($idsToRemove, (int)$booked['huone_ID']);
    }

    foreach ($a as $room) {
        $filterThis = false;
        foreach ($idsToRemove as $id) {
            if ((int)$room['huone_ID'] === $id) {
                $filterThis = true;
                break;
            }
        }
        if (!$filterThis) array_push($result, $room);
    }

    return $result;
} */

?>

<?php
// MAIN

// receive data from the front-end
$searchData = json_decode(file_get_contents("php://input"), true);

// Bind data
$hotel = $searchData['location'];
$size = $searchData['roomSize'];
$startDate = $searchData['startDate'];
$endDate = $searchData['endDate'];

// Get rooms based on data
$availableRooms = get_available_rooms((int)$hotel, (int)$size, $startDate, $endDate);

// send rooms to the front-end
if (empty($availableRooms)) exit(json_encode("No rooms found."));
else echo (json_encode($availableRooms));
?>