<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title . ' | '. (core\Response::COMPANY_NAME)?></title>
  
  <link href="/public/css/newBootstrap.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    /* Update the background to use the image from the directory */
    .full-width-card {
      background: url('/public/img/lockscreen.png') no-repeat center center/cover;
      height: 450px;
    }
    .stats-card {
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: none;
      padding: 20px;
      border-radius: 10px;
    }
    .stats-card .display-5 {
      font-weight: bold;
      font-size: 2.5rem;
      color: #333;
    }
    .form-card {
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: none;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }
    .table-container {
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .export-btn {
      margin-left: auto;
    }
    
  </style>
</head>
<body>
