<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_questfetch
 * @copyright   2023 someone something@example.com
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
$PAGE->set_url(new moodle_url('/local/questfetch/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Fetch Questions.');

echo $OUTPUT->header();
$apiUrl = "http://127.0.0.1:5000/questfetch"; 
$response = file_get_contents($apiUrl);
if ($response === false) {
    echo 'Error fetching questions from the API';
    exit;
}

$questionsData = json_decode($response, true);
if ($questionsData === null) {
    echo 'Error decoding JSON response';
    exit;
}
// Assuming your JSON structure contains 'level' for Bloom's level and 'co' for CO.
$data = [
    'questions' => $questionsData[0]['questions'],
    'blooms_level' => $questionsData[0]['level'], // Adjust the key based on your JSON structure
    'co' => $questionsData[0]['co'], // Adjust the key based on your JSON structure
];

echo $OUTPUT->render_from_template('local_questfetch/manage', $data);


//echo $OUTPUT->footer();