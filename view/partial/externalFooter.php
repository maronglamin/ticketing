<!-- Footer -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script>
  // Function to export table to CSV
  function exportTableToCSV(filename) {
    const table = document.getElementById('ticketTable');
    let rows = table.querySelectorAll('tr');
    
    // Check if rows exist
    if (rows.length === 0) {
      console.error("No rows found in the table.");
      return;
    }

    let csvContent = '';
    
    // Loop through each row to create CSV content
    rows.forEach(row => {
      let cols = row.querySelectorAll('td, th');
      let rowData = [];
      
      // Loop through each column in the row to get the text content
      cols.forEach(col => rowData.push(col.innerText.trim()));
      csvContent += rowData.join(',') + '\n';  // Join row data with commas and add newline
    });

    // Debugging CSV content to ensure it's generated correctly
    console.log("CSV Content: ", csvContent);

    // Create a Blob from the CSV data
    const blob = new Blob([csvContent], { type: 'text/csv' });

    // Create an invisible link to download the CSV
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = filename;

    // Simulate a click to download the file
    link.click();
  }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        // Replace body content with the printable div content
        document.body.innerHTML = printContents;

        // Trigger print
        window.print();

        // Restore original body content
        document.body.innerHTML = originalContents;

        // Optional: Reload the page to restore event listeners and scripts
        location.reload();
    }
</script>
