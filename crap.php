<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Simple Image Gallery</title>
    <style>
      .img-box {
        display: inline-block;
        text-align: center;
        margin: 0 15px;
      }
    </style>
  </head>
  <body>
    <?php
    // Array encompassing sample image file names
    $images = ["kites.jpg", "balloons.jpg"];

    // Looping through the array to generate an image gallery
    foreach ($images as $image) {
        echo '<div class="img-box">';
        echo '<img src="images/' . $image . '" width="200" alt="' . pathinfo($image, PATHINFO_FILENAME) . '">';
        echo '<p><a href="download.php?file=' . urlencode($image) . '">Download</a></p>';
        echo '</div>';
    }
    ?>

  </body>
</ht

<?php

if (isset($_REQUEST["file"])) {
  // Get parameters
  $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string

  /* Check if the file name includes illegal characters
   like "../" using the regular expression */
  if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)) {
    $filepath = "images/" . $file;

    // Process download
    if (file_exists($filepath)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filepath));
      flush(); // Flush system output buffer
      readfile($filepath);
      die();
    } else {
      http_response_code(404);
      die();
    }
  } else {
    die("Invalid file name!");
  }
}

?>





<!DOCTYPE html>
<html>
<head>
    <title>PDF Example</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Example</h1>
    
    <form method="post" action="generate-pdf.php">
        
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity" id="quantity">
        
        <button>Generate PDF</button>
    </form>
</body>
</html>
generate-pdf.php
<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$name = $_POST["name"];
$quantity = $_POST["quantity"];

//$html = '<h1 style="color: green">Example</h1>';
//$html .= "Hello <em>$name</em>";
//$html .= '<img src="example.png">';
//$html .= "Quantity: $quantity";

/**
 * Set the Dompdf options
 */
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

/**
 * Set the paper size and orientation
 */
$dompdf->setPaper("A4", "landscape");

/**
 * Load the HTML and replace placeholders with values from the form
 */
$html = file_get_contents("template.html");

$html = str_replace(["{{ name }}", "{{ quantity }}"], [$name, $quantity], $html);

$dompdf->loadHtml($html);
//$dompdf->loadHtmlFile("template.html");

/**
 * Create the PDF and set attributes
 */
$dompdf->render();

$dompdf->addInfo("Title", "An Example PDF"); // "add_info" in earlier versions of Dompdf

/**
 * Send the PDF to the browser
 */
$dompdf->stream("invoice.pdf", ["Attachment" => 0]);

/**
 * Save the PDF file locally
 */
$output = $dompdf->output();
file_put_contents("file.pdf", $output);



template.html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6">
    <style>
        table {
            width: 100%;
        }
        footer {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    
    <img src="example.png">
    
    <h1>Invoice</h1>
    
    <p>Name: {{ name }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>A sample product</td>
                <td style="text-align: right">{{ quantity }}</td>
            </tr>
        </tbody>
    </table>
    
    <footer>
        This is an example
    </footer>
    
</body>
</html>

// load pdf ends

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            if($count > 0)
            {
                $fullname = $row['0'];
                $email = $row['1'];
                $phone = $row['2'];
                $course = $row['3'];

                $studentQuery = "INSERT INTO students (fullname,email,phone,course) VALUES ('$fullname','$email','$phone','$course')";
                $result = mysqli_query($con, $studentQuery);
                $msg = true;
            }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location: index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: index.php');
        exit(0);
    }
}

<div class="card">
                    <div class="card-header">
                        <h4>How to Import Excel Data into database in PHP</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST" enctype="multipart/form-data">

                            <input type="file" name="import_file" class="form-control" />
                            <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">Import</button>

                        </form>

                    </div>
                </div>












top search box

<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
<div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
        </button>
    </div>
</div>
</form>


search bar visible for XS screen

<!-- <li class="nav-item dropdown no-arrow d-sm-none">
<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-search fa-fw"></i>
</a>
<!-- Dropdown - Messages -->
<!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
    <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div>
</li>  -->

<form 
                        method="POST" 
                        action="<?= route('') ?>">
                        <input 
                            type="hidden"
                            name="_method"
                            value="DELETE">

                        <input 
                            type="hidden"
                            name="id"
                            id="id"
                            value="">
                            <button 
                                class="btn btn-sm btn-block btn-outline-danger mt-4">
                                Delete
                            </button>

                    </form>


select y.CategoryID, 
    y.CategoryName,
    round(x.actual_unit_price, 2) as "Actual Avg Unit Price",
    round(y.planned_unit_price, 2) as "Would-Like Avg Unit Price"
from
(
    select avg(a.UnitPrice) as actual_unit_price, c.CategoryID
    from order_details as a
    inner join products as b on b.ProductID = a.ProductID
    inner join categories as c on b.CategoryID = c.CategoryID
    group by c.CategoryID
) as x
inner join 
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products as a
    inner join categories as b on b.CategoryID = a.CategoryID
    group by a.CategoryID
) as y on x.CategoryID = y.CategoryID