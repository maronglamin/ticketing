<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title . ' | '. (core\Response::COMPANY_NAME)?></title>
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico" />

    <link href="/public/css/newBootstrap.css" rel="stylesheet">
    <link href="/public/css/main.css" rel="stylesheet" type="text/css">
    <script src="/public/js/bootstCDN.js"></script>

</head>
<style>
    body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .explorer-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .folder-icon {
            font-size: 24px;
            color: #f0ad4e;
        }
        .file-icon {
            font-size: 20px;
            color: #0275d8;
        }
        .action-icons {
            font-size: 16px;
            margin-left: 10px;
        }
        .action-icons a {
            text-decoration: none;
        }
        .action-icons a:hover {
            text-decoration: underline;
        }

        .details-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative; /* Needed for absolute positioning of header/footer */
        }
        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .details-header h5 {
            margin: 0;
        }
        .back-btn {
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }
        .back-btn:hover {
            text-decoration: underline;
        }
        .details-row {
            margin-top: 15px;
        }
        .details-key {
            font-weight: bold;
            color: #6c757d;
            width: 150px;
        }
        .details-value {
            color: #343a40;
        }
        .declaration {
            font-style: italic;
            margin-top: 20px;
            border-top: 1px solid #6c757d;
            padding-top: 10px;
        }
        .logo {
            height: 100px; /* Adjust as needed */
        }
        .attached-files img {
            width: 100%;     /* Full width of the container */
            height:auto;     /* Maintain aspect ratio with auto height */
            margin-bottom:10px; /* Space between images */
            border: 5px dotted black;
        }

        .summary-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .transaction-table {
            background: #ffffff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }

        .details-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .details-header h5 {
            margin: 0;
        }
        .back-btn {
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }
        .back-btn:hover {
            text-decoration: underline;
        }
        .details-row {
            margin-top: 15px;
        }
        .details-key {
            font-weight: bold;
            color: #6c757d;
            width: 300px;
        }
        .details-value {
            color: #343a40;
        }

        .form-card {
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-section {
            display: flex;
            justify-content: flex-end;
        }



        /* Print Styles */
        @media print {
            body {
                background-color: white; /* Ensure white background for printing */
                color: black; /* Ensure black text for printing */
                margin: 0;  /* Remove default margins */
                padding: 0;  /* Remove default padding */
                font-size: 12pt; /* Adjust font size for print */
            }
            .back-btn, button {
                display: none; /* Hide buttons and back link when printing */
            }
            
            .header, .footer {
                position: fixed; /* Keep header/footer fixed */
                left: 0; 
                right: 0; 
                text-align: center; 
                font-size: 14pt; /* Font size for header/footer */
                padding: 10px; 
                background-color: white; /* Background color for header/footer */
                border-bottom: 1px solid #ccc; /* Border for header */
                z-index: 1000; /* Ensure it stays on top */
            }

            .header {
                top: 0; /* Position at the top */
            }

            .footer {
                bottom: 0; /* Position at the bottom */
                border-top: 1px solid #ccc; /* Border for footer */
            }

            .details-container {
                box-shadow: none; /* Remove shadow for print */
                border-radius: 0; /* Remove rounded corners for print */
                padding-bottom: 50px; /* Space for footer */
                padding-top: 50px; /* Space for header */
                margin-bottom: 20px; /* Add bottom margin for print */
                page-break-after: always; /* Ensure proper page breaks */
            }

            .attached-files {
                margin-top: 20px;
                border-top: 1px solid #6c757d;
                padding-top: 10px;
                page-break-inside: avoid; /* Prevent page break inside this section */
             }

             .attached-files img {
                 width: 100%;     /* Full width of the container */
                 height:auto;     /* Maintain aspect ratio with auto height */
                 margin-bottom:10px; /* Space between images */
		        border: 5px dotted black;
             }

             
        }

</style>
<body class="bg-light">

