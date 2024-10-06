angular.module('patientApp', [])
  .controller('GraphController', ['$scope', '$http', '$filter', function ($scope, $http, $filter) {


    function calculateBMI(weight, heightCm) {
      const heightM = heightCm / 100;
      return (weight / (heightM * heightM)).toFixed(2);
    }

    function processPatientData(data) {
      let bmiByYear = {};

      data.forEach(record => {
        const year = new Date(record.date_treatment).getFullYear();
        const date = new Date(record.date_treatment);
        const formattedDate = $filter('date')(record.date_treatment, 'dd/MM/yyyy');
        const weight = record.weight;
        const height = record.height;
        const bmi = calculateBMI(weight, height);

        if (!bmiByYear[year]) {
          bmiByYear[year] = [];
        }
        bmiByYear[year].push({ date: formattedDate, dateObj: date, bmi: parseFloat(bmi) });
      });

      // Sort each year's data by date

      Object.keys(bmiByYear).forEach(year => {
        bmiByYear[year].sort((a, b) => a.dateObj - b.dateObj);
      });

      console.log(bmiByYear);

      return bmiByYear;
    }

    function processBloodPressureData(data) {
      let bpByYear = {};

      data.forEach(record => {
        const year = new Date(record.date_treatment).getFullYear();
        const date = new Date(record.date_treatment);
        const formattedDate = $filter('date')(record.date_treatment, 'dd/MM/yyyy');
        const bps = record.bps;
        const bpd = record.bpd;

        if (!bpByYear[year]) {
          bpByYear[year] = { dates: [], bps: [], bpd: [] };
        }
        bpByYear[year].dates.push(formattedDate);
        bpByYear[year].bps.push(parseFloat(bps));
        bpByYear[year].bpd.push(parseFloat(bpd));
      });

      // Sort each year's data by date
      Object.keys(bpByYear).forEach(year => {
        bpByYear[year].dates.sort((a, b) => {
          // Convert 'dd/MM/yyyy' back to Date object for sorting
          const dateA = new Date(a.split('/').reverse().join('-'));
          const dateB = new Date(b.split('/').reverse().join('-'));
          return dateA - dateB;
        });
      });

      return bpByYear;
    }



    $scope.select = function () {
      $http({
        method: 'POST',
        url: 'patient_his_select.php',
        headers: {
          'Content-Type': undefined
        },
        data: $scope.s
      }).then(
        function (z) {
          $scope.list = z.data;
          let result = processPatientData($scope.list);
          document.getElementById('chartsContainer').innerHTML = '';
          Object.keys(result).forEach(year => {
            let labels = result[year].map(item => item.date);
            let data = result[year].map(item => item.bmi);

            let div = document.createElement('div');
            let canvas = document.createElement('canvas');
            canvas.id = `chart-${year}`;
            div.classList.add('col-md-6');
            div.appendChild(canvas)
            document.getElementById('chartsContainer').appendChild(div);
            updateChartBMI(`chart-${year}`, year, labels, data);
          });
        },
        function (response) {
          // Handle error
        }
      );
    }

    $scope.select2 = function () {
      $http({
        method: 'POST',
        url: 'patient_his_select.php',
        headers: {
          'Content-Type': undefined
        },
        data: $scope.s
      }).then(
        function (z) {
          $scope.bpd = z.data;
          let result = processBloodPressureData($scope.bpd);

          document.getElementById('chartsContainer').innerHTML = ''; // Clear previous charts

          Object.keys(result).forEach(year => {
            let labels = result[year].dates; // Dates for that year
            let bpsData = result[year].bps;  // Systolic for that year
            let bpdData = result[year].bpd;  // Diastolic for that year

            let div = document.createElement('div');
            let canvas = document.createElement('canvas');
            canvas.id = `chart-${year}`;
            div.classList.add('col-md-6');
            div.appendChild(canvas);
            document.getElementById('chartsContainer').appendChild(div);

            updateChartBPD(`chart-${year}`, year, labels, bpsData, bpdData);
          });
        },
        function (response) {
          // Handle error
        }
      );
    };


    function updateChartBMI(chartId, year, labels, data) {
      const ctx = document.getElementById(chartId).getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels, // Dates of treatment for the specific year
          datasets: [{
            label: `BMI for Year ${year}`,
            data: data, // BMI values for that year
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
    function updateChartBPD(chartId, year, labels, bpsData, bpdData) {
      const ctx = document.getElementById(chartId).getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels, // Dates of treatment for the specific year
          datasets: [
            {
              label: `( BPs ) การวัดหัวใจขณะหัวใจบีบตัว ${year}`,
              data: bpsData, // Systolic values for that year
              fill: false,
              borderColor: 'rgb(255, 99, 132)',
              tension: 0.1
            },
            {
              label: `(BPd) การวัดค่าหัวใจขณะคลายตัว ${year}`,
              data: bpdData, // Diastolic values for that year
              fill: false,
              borderColor: 'rgb(54, 162, 235)',
              tension: 0.1
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: false,
              title: {
                display: true,
                text: 'ความดันโลหิต'
              }
            },
            x: {
              title: {
                display: true,
                text: 'วัน / เดือน / ปี'
              }
            }
          }
        }
      });
    }



  }]);
