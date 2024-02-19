<?php
include_once("../php/db-cred.php");

function connect_to_db($databaseName)
{
    $conn = new mysqli(SERVER, USERNAME, PASSWORD, $databaseName);
    if ($conn->connect_error) {
        http_response_code(400);
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

function upload_varaus($huodeID, $asiakasID, $alkuPvm, $loppuPvm)
{
    $conn = connect_to_db(DB);
    $stmt = $conn->prepare("INSERT INTO huoneidenvaraukset (huone_ID, asiakas_ID, alku_pvm, loppu_pvm) VALUES (?, ?, ?, ?);");
    $stmt->bind_param("iiss", $huodeID, $asiakasID, $alkuPvm, $loppuPvm);
    $stmt->execute();

    $conn->close();
}

function confirm_available($id, $start, $end)
{
    // connect to DB
    $db = connect_to_db(DB);

    // query DB
    $stmt = $db->prepare('SELECT * FROM huoneet 
                        WHERE huone_ID = ?
                        AND huone_ID IN (SELECT huone_ID FROM huoneidenvaraukset 
                        WHERE 
                        ? BETWEEN alku_pvm AND loppu_pvm
                        OR
                        ? BETWEEN alku_pvm AND loppu_pvm
                        OR
                        ? < alku_pvm and ? > loppu_pvm);');

    $stmt->bind_param('issss', $id, $start, $end, $start, $end);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows <= 0) return true;
    else return false;
}

function check_customer($sposti)
{
    // connect to DB
    $db = connect_to_db(DB);

    // query DB
    $stmt = $db->prepare('SELECT * FROM asiakkaat WHERE sposti = ?;');

    $stmt->bind_param('s', $sposti);
    $stmt->execute();

    $result = $stmt->get_result();

    // disconnect from DB
    $db->close();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        // return query results
        return $customers[0]['asiakas_ID'];
    } else {
        return null;
    }
}

function upload_customer($etunimi, $sukunimi, $sposti, $puhelin)
{
    // connect to DB
    $db = connect_to_db(DB);

    // query DB
    $stmt = $db->prepare('INSERT INTO asiakkaat (etunimi, sukunimi, sposti, puhelin) VALUES (?, ?, ?, ?)');

    $stmt->bind_param('sssi', $etunimi, $sukunimi, $sposti, $puhelin);
    $stmt->execute();
}

// MAIN
// Get data
$varaus = json_decode(file_get_contents("php://input"), true);

// Assign data to variables
$etunimi = $varaus['etunimi'];
$sukunimi = $varaus['sukunimi'];
$puhelin = $varaus['puhelin'];
$sposti = $varaus['sposti'];

$huoneID = $varaus['huoneID'];
$start = $varaus['enterDate'];
$end = $varaus['exitDate'];

// Does customer exist
$asiakasID = check_customer($sposti);
if ($asiakasID == null) {
    upload_customer($etunimi, $sukunimi, $sposti, $puhelin);
    $asiakasID = check_customer($sposti);
}
if ($asiakasID == null) {
    http_response_code(400);
    exit(json_encode(":("));
}

// Send data
if (confirm_available($huoneID, $start, $end)) {
    upload_varaus($huoneID, $asiakasID, $start, $end);
    exit(json_encode("Doneds."));
} else {
    http_response_code(400);
    exit(json_encode("Room unavailable"));
}
