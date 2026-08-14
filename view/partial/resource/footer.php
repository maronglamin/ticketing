<script>
    // Function to export JSON data to CSV
function exportJSONToCSV(filename, jsonData) {
    // Check if jsonData exists and is an array
    if (!Array.isArray(jsonData) || jsonData.length === 0) {
        console.error("No valid JSON data to export.");
        return;
    }

    // Get the headers from the first object in the array
    const headers = Object.keys(jsonData[0]);

    let csvContent = headers.join(',') + '\n';  // Add headers as the first row

    // Loop through each object in the JSON array
    jsonData.forEach(row => {
        let rowData = headers.map(header => {
            let cellData = row[header] === null || row[header] === undefined ? '' : row[header];
            // Escape commas and quotes in the cell data
            cellData = cellData.toString().replace(/"/g, '""');
            if (cellData.includes(',') || cellData.includes('"') || cellData.includes('\n')) {
                cellData = `"${cellData}"`;
            }
            return cellData;
        });
        csvContent += rowData.join(',') + '\n';  // Join row data with commas and add newline
    });

    // Create a Blob from the CSV data
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

    // Create an invisible link to download the CSV
    const link = document.createElement('a');
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

// Example JSON data (replace this with your actual data)
let jsonData = <?= $export; ?>

// Add click event listener to the export button
document.getElementById('exportButton').addEventListener('click', function() {
    // Generate filename with current timestamp
    const now = new Date();
    const timestamp = now.getFullYear() + '-' +
                      String(now.getMonth() + 1).padStart(2, '0') + '-' +
                      String(now.getDate()).padStart(2, '0') + '_' +
                      String(now.getHours()).padStart(2, '0') + '-' +
                      String(now.getMinutes()).padStart(2, '0') + '-' +
                      String(now.getSeconds()).padStart(2, '0');
    const filename = `APSW_IMS_Ticketing_Export_report_${timestamp}.csv`;

    exportJSONToCSV(filename, jsonData);
});

function toggleFilter() {
    let filterSection = document.getElementById("filterSection");
    let toggleBtn = document.getElementById("toggleBtn");

    if (filterSection.classList.contains("max-h-0")) {
        filterSection.classList.remove("max-h-0");
        filterSection.classList.add("max-h-[500px]"); // Expand
        toggleBtn.textContent = "➖ Close";
    } else {
        filterSection.classList.remove("max-h-[500px]");
        filterSection.classList.add("max-h-0"); // Collapse
        toggleBtn.textContent = "➕ Open";
    }
}

</script>


</main>
</body>
</html>