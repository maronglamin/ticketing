<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?> | IMS Ticketing</title>
    <link rel="icon" type="image/x-icon" href="<?= root()?>/public/img/favicon.ico" />


    <script src="/uat_env/view/partial/resource/asset/tailwind.js"></script>
    <script>
    function formatDateTime(date) {
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let day = String(date.getDate()).padStart(2, '0');
            let hours = String(date.getHours()).padStart(2, '0');
            let minutes = String(date.getMinutes()).padStart(2, '0');
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        function setDefaultDateTime() {
            let now = new Date();
            
            // Start Date: Today at 00:00 AM
            let startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0);
            
            // End Date: Today at 23:59 PM
            let endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59,59);

            document.getElementById("start-date").value = formatDateTime(startDate);
            document.getElementById("end-date").value = formatDateTime(endDate);
        }

        window.onload = setDefaultDateTime;
</script>
</head>
<body class="min-h-screen bg-white text-black">