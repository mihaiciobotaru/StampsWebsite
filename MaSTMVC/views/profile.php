<?php

/** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Profile';


$dataPoints = array(
    array("x"=> '10', "y"=> 41),
    array("x"=> '20', "y"=> 35, "indexLabel"=> "Lowest"),
    array("x"=> 30, "y"=> 50),
    array("x"=> 40, "y"=> 45),
    array("x"=> 50, "y"=> 52),
    array("x"=> 60, "y"=> 68),
    array("x"=> 70, "y"=> 38),
    array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
    array("x"=> 90, "y"=> 52),
    array("x"=> 100, "y"=> 60),
    array("x"=> 110, "y"=> 36),
    array("x"=> 120, "y"=> 49),
    array("x"=> 130, "y"=> 41)
);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />

    <link rel="stylesheet" href="../views/css/main.css" />
    <link rel="stylesheet" href="../views/css/profile.css" />

    <title>Stamp Worldn't</title>
</head>

<body>
    <div id="profile-wrapper">
        <div id="profile-info">
            <img src="../views/assets/blank-profile-picture.png" alt="Profile picture" />
            <h1><?php echo Application::$app->user->firstname . ' ' . Application::$app->user->lastname ?></h1>
            <div class="profile-description-table">
                <table>
                    <tbody>
                        <tr>
                            <th>User Name </th>
                            <td><?php echo Application::$app->user->username ?> </td>
                        </tr>
                        <tr>
                            <th>Member since </th>
                            <td><?php echo Application::$app->user->getCreatedTime()?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="profile-content">
            <div class="buttons-container">
                <a class="profile-content-button" style="color: #5ba7e8">Statistics</a>
                <a href="/MaSTMVC/index.php/profile/mystamps" class="profile-content-button">My Stamps</a>
                <a href="/MaSTMVC/index.php/profile/mycatalogues" class="profile-content-button">
                    My Catalogues
                </a>
            </div>
            <script>
                window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        exportEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"
                        title:{
                            text: "Stamps Posted This Week"
                        },
                        axisY:{
                            includeZero: true
                        },
                        data: [{
                            type: "column", //change type to bar, line, area, pie, etc
                            //indexLabel: "{y}", //Shows y value on all Data Points
                            indexLabelFontColor: "#5A5757",
                            indexLabelPlacement: "outside",
                            dataPoints: <?php echo json_encode($stampsPostedThisWeekData, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart.render();

                    var chart2 = new CanvasJS.Chart("chartContainer2", {
                        animationEnabled: true,
                        exportEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"
                        title:{
                            text: "Stamps Liked This Month"
                        },
                        axisY:{
                            includeZero: true
                        },
                        data: [{
                            type: "column", //change type to bar, line, area, pie, etc
                            //indexLabel: "{y}", //Shows y value on all Data Points
                            indexLabelFontColor: "#5A5757",
                            indexLabelPlacement: "outside",
                            dataPoints: <?php echo json_encode($stampsLikedThisMonth, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart2.render();

                }
            </script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <div id="chartContainer" style="height: 370px; width: 70%; display:block;"></div>
            <div id="chartContainer2" style="height: 370px; width: 70%; display:block;"></div>

        </div>
    </div>
</body>

</html>