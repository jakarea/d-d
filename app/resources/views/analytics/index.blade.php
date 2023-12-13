@extends('layouts/auth')

@section('title','Analytics Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper analytics-page-wrapper">
  <div class="row">
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-01.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-01.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$10,540</h4>
        <p>Total Earning</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$1,540</h4>
        <p>Earning Today</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-03.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-03.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$8,350</h4>
        <p>Total Customer Payment</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$3,240</h4>
        <p>Total Due Amount</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-01.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-01.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$3,240</h4>
        <p>Total Due Amount</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$3,240</h4>
        <p>Total Due Amount</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-10.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-08.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$1,220</h4>
        <p>New Customer</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-11.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-05.svg') }}" alt="I" class="img-fluid">
        </div>

        <h4>$1,350</h4>
        <p>Total Frozen Account</p>
      </div>
    </div>
    <!-- card item end -->
  </div>

  <div class="row">
    <div class="col-12 mb-15">
      <!-- earinings graph start -->
      <div class="chart-box-wrap">
        <div class="graph-head">
          <h5>Earnings</h5>
          <p><span><img src="{{ asset('/public/assets/images/icons/arrow-top.svg') }}" alt="I" class="img-fluid"> 40%</span> vs last month</p>
        </div>
        <div id="earningChart"></div>
      </div>
      <!-- earinings graph end -->
    </div>
  </div>

  <!-- total user and products graph start -->
  <div class="row mb-15">
    <div class="col-lg-8">
      <div class="chart-box-wrap">
        <div class="graph-head mb-15">
          <h5>Total User</h5>
        </div>
        <div id="totalUser"></div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="chart-box-wrap">
        <div class="graph-head">
          <h5>Products</h5>
        </div>
        <div class="product-progress-box">
          <div class="txt">
            <h5>{{ $totalProducts }}</h5>
            <p>Total Products</p>
          </div>
          <canvas id="productStatus"></canvas>
          <div id="legend" class="legend center-legend"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- total user and products graph end -->

  <!-- company user graph start -->
  <div class="row">
    <div class="col-lg-8">
      <div class="chart-box-wrap">
        <div class="graph-head custom-flex mb-15">
          <h5>Company User</h5>
          <div class="header-flex">
            <div>
              <span style="background-color: #00AB55;"></span> Active Company User
            </div>
            <div>
              <span style="background-color: #FFAB00;"></span> Inactive Company User
            </div>
          </div>
        </div>
        <div id="companyUser"></div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="top-active-company-user">
        <h4>Top Active Company User</h4>
        <div class="user-list">
          @foreach ($activeCompanyUsers->slice(0,5) as $index => $activeCompanyUser)
          <!-- user one start -->
          <div class="media">

            @if ($activeCompanyUser->personalInfo && $activeCompanyUser->personalInfo->avatar) 
            <img src="{{ $activeCompanyUser->personalInfo->avatar }}" alt="A" class="img-fluid">
            @else 
            <span class="no-avatar nva-sm me-3" style="width: 2.75rem; height: 2.75rem;">{!! strtoupper(auth()->user()->name[0]) !!}</span>
            @endif 

            <div class="media-body">
              <h5><a href="{{ route('company.show', $activeCompanyUser->company) }}">{{ $activeCompanyUser->name }}</a></h5>
              <p>{{ $activeCompanyUser->email }}</p>
            </div> 

            @if ($index == 0)
            <img src="{{ asset('/public/assets/images/icons/trophy-01.svg') }}" alt="T" class="img-fluid">
            @elseif ($index == 1)
                <img src="{{ asset('/public/assets/images/icons/trophy-02.svg') }}" alt="T" class="img-fluid">
            @else
                <img src="{{ asset('/public/assets/images/icons/trophy-03.svg') }}" alt="T" class="img-fluid">
            @endif 
          </div>
          <!-- user one end --> 
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- company user graph end -->

</section>
<!-- main page wrapper end -->
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- earning graph js start -->
<script>
  var options = {
  series: [{
    data: [
      [1327359600000, 30.95],
      [1327446000000, 31.34],
      [1327532400000, 31.18],
      [1327618800000, 31.05],
      [1327878000000, 31.00],
      [1327964400000, 30.95],
      [1328050800000, 31.24],
      [1328137200000, 31.29],
      [1328223600000, 31.85],
      [1328482800000, 31.86],
      [1328569200000, 32.28],
      [1328655600000, 32.10],
      [1328742000000, 32.65],
      [1328828400000, 32.21],
      [1329087600000, 32.35],
      [1329174000000, 32.44],
      [1329260400000, 32.46],
      [1329346800000, 32.86],
      [1329433200000, 32.75],
      [1329778800000, 32.54],
      [1329865200000, 32.33],
      [1329951600000, 32.97],
      [1330038000000, 33.41],
      [1330297200000, 33.27],
      [1330383600000, 33.27],
      [1330470000000, 32.89],
      [1330556400000, 33.10],
      [1330642800000, 33.73],
      [1330902000000, 33.22],
      [1330988400000, 31.99],
      [1331074800000, 32.41],
      [1331161200000, 33.05],
      [1331247600000, 33.64],
      [1331506800000, 33.56],
      [1331593200000, 34.22],
      [1331679600000, 33.77],
      [1331766000000, 34.17],
      [1331852400000, 33.82],
      [1332111600000, 34.51],
      [1332198000000, 33.16],
      [1332284400000, 33.56],
      [1332370800000, 33.71],
      [1332457200000, 33.81],
      [1332712800000, 34.40],
      [1332799200000, 34.63],
      [1332885600000, 34.46],
      [1332972000000, 34.48],
      [1333058400000, 34.31],
      [1333317600000, 34.70],
      [1333404000000, 34.31],
      [1333490400000, 33.46],
      [1333576800000, 33.59],
      [1333922400000, 33.22],
      [1334008800000, 32.61],
      [1334095200000, 33.01],
      [1334181600000, 33.55],
      [1334268000000, 33.18],
      [1334527200000, 32.84],
      [1334613600000, 33.84],
      [1334700000000, 33.39],
      [1334786400000, 32.91],
      [1334872800000, 33.06],
      [1335132000000, 32.62],
      [1335218400000, 32.40],
      [1335304800000, 33.13],
      [1335391200000, 33.26],
      [1335477600000, 33.58],
      [1335736800000, 33.55],
      [1335823200000, 33.77],
      [1335909600000, 33.76],
      [1335996000000, 33.32],
      [1336082400000, 32.61],
      [1336341600000, 32.52],
      [1336428000000, 32.67],
      [1336514400000, 32.52],
      [1336600800000, 31.92],
      [1336687200000, 32.20],
      [1336946400000, 32.23],
      [1337032800000, 32.33],
      [1337119200000, 32.36],
      [1337205600000, 32.01],
      [1337292000000, 31.31],
      [1337551200000, 32.01],
      [1337637600000, 32.01],
      [1337724000000, 32.18],
      [1337810400000, 31.54],
      [1337896800000, 31.60],
      [1338242400000, 32.05],
      [1338328800000, 31.29],
      [1338415200000, 31.05],
      [1338501600000, 29.82],
      [1338760800000, 30.31],
      [1338847200000, 30.70],
      [1338933600000, 31.69],
      [1339020000000, 31.32],
      [1339106400000, 31.65],
      [1339365600000, 31.13],
      [1339452000000, 31.77],
      [1339538400000, 31.79],
      [1339624800000, 31.67],
      [1339711200000, 32.39],
      [1339970400000, 32.63],
      [1340056800000, 32.89],
      [1340143200000, 31.99],
      [1340229600000, 31.23],
      [1340316000000, 31.57],
      [1340575200000, 30.84],
      [1340661600000, 31.07],
      [1340748000000, 31.41],
      [1340834400000, 31.17],
      [1340920800000, 32.37],
      [1341180000000, 32.19],
      [1341266400000, 32.51],
      [1341439200000, 32.53],
      [1341525600000, 31.37],
      [1341784800000, 30.43],
      [1341871200000, 30.44],
      [1341957600000, 30.20],
      [1342044000000, 30.14],
      [1342130400000, 30.65],
      [1342389600000, 30.40],
      [1342476000000, 30.65],
      [1342562400000, 31.43],
      [1342648800000, 31.89],
      [1342735200000, 31.38],
      [1342994400000, 30.64],
      [1343080800000, 30.02],
      [1343167200000, 30.33],
      [1343253600000, 30.95],
      [1343340000000, 31.89],
      [1343599200000, 31.01],
      [1343685600000, 30.88],
      [1343772000000, 30.69],
      [1343858400000, 30.58],
      [1343944800000, 32.02],
      [1344204000000, 32.14],
      [1344290400000, 32.37],
      [1344376800000, 32.51],
      [1344463200000, 32.65],
      [1344549600000, 32.64],
      [1344808800000, 32.27],
      [1344895200000, 32.10],
      [1344981600000, 32.91],
      [1345068000000, 33.65],
      [1345154400000, 33.80],
      [1345413600000, 33.92],
      [1345500000000, 33.75],
      [1345586400000, 33.84],
      [1345672800000, 33.50],
      [1345759200000, 32.26],
      [1346018400000, 32.32],
      [1346104800000, 32.06],
      [1346191200000, 31.96],
      [1346277600000, 31.46],
      [1346364000000, 31.27],
      [1346709600000, 31.43],
      [1346796000000, 32.26],
      [1346882400000, 32.79],
      [1346968800000, 32.46],
      [1347228000000, 32.13],
      [1347314400000, 32.43],
      [1347400800000, 32.42],
      [1347487200000, 32.81],
      [1347573600000, 33.34],
      [1347832800000, 33.41],
      [1347919200000, 32.57],
      [1348005600000, 33.12],
      [1348092000000, 34.53],
      [1348178400000, 33.83],
      [1348437600000, 33.41],
      [1348524000000, 32.90],
      [1348610400000, 32.53],
      [1348696800000, 32.80],
      [1348783200000, 32.44],
      [1349042400000, 32.62],
      [1349128800000, 32.57],
      [1349215200000, 32.60],
      [1349301600000, 32.68],
      [1349388000000, 32.47],
      [1349647200000, 32.23],
      [1349733600000, 31.68],
      [1349820000000, 31.51],
      [1349906400000, 31.78],
      [1349992800000, 31.94],
      [1350252000000, 32.33],
      [1350338400000, 33.24],
      [1350424800000, 33.44],
      [1350511200000, 33.48],
      [1350597600000, 33.24],
      [1350856800000, 33.49],
      [1350943200000, 33.31],
      [1351029600000, 33.36],
      [1351116000000, 33.40],
    ]
  }],
  chart: {
    id: 'area-datetime',
    type: 'area',
    height: 350,
    toolbar: {
      show: false
    },
    zoom: {
      autoScaleYaxis: true
    }
  },
  dataLabels: {
    enabled: false
  },
  markers: {
    size: 0,
    style: 'hollow',
  },
  xaxis: {
    type: 'datetime',
    tickAmount: 6,
  },
  colors: ['#FFBF71'],
  tooltip: {
    x: {
      format: 'dd MMM yyyy'
    }
  },
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
      stops: [0, 100]
    }
  },
};

var chart = new ApexCharts(document.querySelector("#earningChart"), options);
chart.render();
</script>
<!-- earning graph js end -->

<!-- total user graph js start -->
<script>

  const totalUsersByMonths = @json($totalUsersByMonths);

  var options = {
  series: [{
    name: 'Total',
    data: totalUsersByMonths
  }],
  chart: {
    type: 'bar',
    height: 350,
    toolbar: {
      show: false
    },
  },
  colors: ['#35B254'],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '30%',
      borderRadius: 2,
      endingShape: 'rounded',

    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  },
  fill: {
    opacity: 1
  },
  grid: {
    show: true,
    borderColor: '#C2C6CE',
    strokeDashArray: 4,
    xaxis: {
      lines: {
        show: false
      }
    },
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return val + " Users"
      }
    }
  }
};

var chart = new ApexCharts(document.querySelector("#totalUser"), options);
chart.render();
</script>
<!-- total user graph js end -->

<!-- product status graph js start -->
<script>
  var datas = [{{ $activeProducts }}, {{ $draftProducts }}];

  var backgroundColor = ['#35B254', '#FFAB00'];
  var ctx = document.getElementById('productStatus').getContext('2d');
  var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Active Product', 'Inactive Product'],
      datasets: [{
        label: 'Product Status',
        data: datas,
        backgroundColor: backgroundColor,
        hoverOffset: 4
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      title: {
        display: true,
        text: 'Chart Donut'
      },
      legend: {
        display: false
      },
      cutout: '70%',
      radius: 110
    }
  });

  // Calculate percentages
  var total = datas.reduce((a, b) => a + b, 0);
  var percentages = datas.map((value) => {
    if (value === 0 || total === 0) {
      return "0%";
    } else {
      return ((value / total) * 100).toFixed(0) + "%";
    }
  });

// Generate and display the custom legend
var legendHtml = "<ul>";
for (var i = 0; i < myDoughnutChart.data.labels.length; i++) {
  legendHtml +=
    '<li>' + '<p> <span style="background-color:' +
    myDoughnutChart.data.datasets[0].backgroundColor[i] +
    '"></span> ' + myDoughnutChart.data.labels[i] + '</p>' + '<h6>' + percentages[i] + '</h6>' +
    "</li>";
}
legendHtml += "</ul>";
document.getElementById("legend").innerHTML = legendHtml;
</script>
<!-- product status graph js end -->

<!-- company user graph js start -->
<script>
 
 const data = @json($activeInactiveCompanyUserCurrentMonth);

  var options = {
  series: [{
    name: 'active',
    data: data
  }, {
    name: 'inactive',
    data: data
  }],
  chart: {
    height: 350,
    type: 'area',
    toolbar: {
      show: false
    },
  },
  dataLabels: {
    enabled: false
  },
  grid: {
    show: true,
    borderColor: '#C2C6CE',
    strokeDashArray: 0,
    xaxis: {
      lines: {
        show: false
      }
    },
  },
  colors: ['#00AB55', '#FFAB00'],
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    },
  },
  legend: {
    show: false // Hide the legend
  },
  toolbar: {
    show: false // Hide the top toolbar
  }
};

var chart = new ApexCharts(document.querySelector("#companyUser"), options);
chart.render();
</script>
<!-- company user graph js end -->
@endsection
