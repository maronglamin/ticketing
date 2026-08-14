<?php

// require 'vendor/autoload.php';

use CpChart\Data;
use CpChart\Image;

// Create and populate the Data object
$data = new Data();
$data->addPoints([4, 2, 10, 12, 8, 3], "Probe 1");
$data->setSerieWeight("Probe 1", 2);
$data->addPoints(["Jan", "Feb", "Mar", "Apr", "May", "Jun"], "Labels");
$data->setAbscissa("Labels");

// Create the Image object
$image = new Image(700, 230, $data);

// Turn off Antialiasing
$image->Antialias = false;

// Draw the background
$image->drawFilledRectangle(0, 0, 700, 230, ["R" => 255, "G" => 255, "B" => 255, "Dash" => true, "DashR" => 200, "DashG" => 200, "DashB" => 200]);

// Add a border to the picture
$image->drawRectangle(0, 0, 699, 229, ["R" => 0, "G" => 0, "B" => 0]);

// Write the chart title
$image->setFontProperties(["FontName" => "fonts/Forgotte.ttf", "FontSize" => 11]);
$image->drawText(150, 35, "My chart title", ["FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMMIDDLE]);

// Draw the scale and the chart
$image->setFontProperties(["FontName" => "fonts/pf_arma_five.ttf", "FontSize" => 6]);

$image->setGraphArea(60, 40, 650, 200);
$image->drawScale(["DrawSubTicks" => true]);
$image->drawLineChart();

// Render the picture (choose one of the methods)
$image->autoOutput("example.drawLineChart.simple.png");