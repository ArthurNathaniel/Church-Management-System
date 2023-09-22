
        // Assuming you have an array of data from your database
        // For example, let's say you have an array of member counts by gender
        var genderData = {
            labels: ['Male', 'Female'],
            datasets: [{
                label: 'Gender Distribution',
                data: [25, 35], // Replace with your actual data
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Get the canvas element
        var ctx = document.getElementById('myChart').getContext('2d');

        // Create a bar chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: genderData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
  
