
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


var ctx = document.getElementById("pie4");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Present", "Absent"],
    datasets: [{
      data: [330,60],
      backgroundColor: ['#4e73df', '#FFFF00'],
      hoverBackgroundColor: ['#2e59d9', '#CCCC00'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
  options: {
    legend: {
        labels: {
            generateLabels: function(chart) {
            }
        }
    }
}
});
