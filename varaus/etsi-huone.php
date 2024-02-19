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

function validate_input($input)
{
    $str = htmlspecialchars(stripslashes(trim($input)));
    $str = str_replace("/", "", $str);
    $str = str_replace("\\", "", $str);
    return $str;
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

?>

<?php
// MAIN

// receive data from the front-end
$searchData = json_decode(file_get_contents("php://input"), true);

if (empty($searchData)) exit(json_encode("Empty input."));
if (
    !isset($searchData['location']) || !isset($searchData['roomSize'])
    || !isset($searchData['startDate']) || !isset($searchData['endDate'])
)
    exit(json_encode('Incorrect input!'));

// Bind data
$hotel = validate_input($searchData['location']);
$size = validate_input($searchData['roomSize']);
$startDate = validate_input($searchData['startDate']);
$endDate = validate_input($searchData['endDate']);

// Get rooms based on data
$availableRooms = get_available_rooms((int)$hotel, (int)$size, $startDate, $endDate);

// send rooms to the front-end
if (empty($availableRooms))
    exit(json_encode("No rooms found."));
else
    echo (json_encode($availableRooms));

?>