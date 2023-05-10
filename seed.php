<?php

require_once '_includes/vendor/autoload.php'; // load the Composer autoloader
include("_includes/config.inc");
include("_includes/dbconnect.inc");

// create a new Faker instance
$faker = Faker\Factory::create();

// define the number of students to generate
$numStudents = 5;

// loop through and generate student data
for ($i = 0; $i < $numStudents; $i++) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $house = $faker->buildingNumber;
    $town = $faker->city;
    $county = $faker->state;
    $country = $faker->country;
    $postcode = $faker->postcode;

    // insert the student data into the database
    $sql = "INSERT INTO student (firstname, lastname, house, town, county, country, postcode) VALUES ('$firstName', '$lastName', '$house', '$town', '$county', '$country', '$postcode')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error inserting data: ' . mysqli_error($conn));
    }
}

echo 'Data inserted successfully!';

?>