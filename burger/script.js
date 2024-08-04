document.getElementById('dataForm').addEventListener('submit', async function(event) {
    event.preventDefault();
    
    const dataInput = document.getElementById('dataInput').value;
    
    const response = await fetch('http://localhost:5000/process-data', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ data: dataInput }),
    });
    
    const result = await response.json();
    
    document.getElementById('result').textContent = `Processed data: ${result.processedData}`;
});
