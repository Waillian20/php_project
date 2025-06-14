const ctx = document.getElementById('myChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
    labels: labels,
    datasets: [{
        label: 'Sales Amount',
        data: data,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }]
    },
    options: {
    responsive: true,
    scales: {
        y: {
        beginAtZero: true
        }
    }
    }
});