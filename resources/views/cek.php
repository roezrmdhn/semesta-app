// Chart Hourly Sales
var ctxHourlySales = document.getElementById("chart-line-hourly-sales").getContext("2d");
var gradientStroke1 = ctxHourlySales.createLinearGradient(0, 230, 0, 50);
gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

var allOutletDataHourlySales = responseDataHourlySales.dataset.map(outlet => outlet.data);
var totalPenjualanHourly = allOutletDataHourlySales[0];

var myChart7 = new Chart(ctxHourlySales, {
type: "line",
data: {
labels: responseDataHourlySales.labels,
datasets: [{
label: "Average Hourly Transactions",
tension: 0.4,
borderWidth: 0,
pointRadius: 0,
borderColor: "#cb0c9f",
borderWidth: 3,
backgroundColor: gradientStroke1,
fill: true,
data: totalPenjualanHourly.map(value => parseFloat(
value)), // Konversi data string ke float
maxBarThickness: 6
}],
},
options: {
responsive: true,
maintainAspectRatio: false,
plugins: {
legend: {
display: false,
}
},
interaction: {
intersect: false,
mode: 'index',
},
scales: {
y: {
grid: {
drawBorder: false,
display: true,
drawOnChartArea: true,
drawTicks: false,
borderDash: [5, 5]
},
ticks: {
display: true,
padding: 10,
color: '#b2b9bf',
font: {
size: 11,
family: "Open Sans",
style: 'normal',
lineHeight: 2
},
}
},
x: {
grid: {
drawBorder: false,
display: true,
drawOnChartArea: true,
drawTicks: false,
borderDash: [5, 5],
},
ticks: {
display: true,
padding: 10,
color: '#b2b9bf',
font: {
size: 11,
family: "Open Sans",
style: 'normal',
lineHeight: 2,
},
},
},
},
},
});