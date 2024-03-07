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
          <img src="{{ asset('/public/assets/images/icons/arrow-up-01.svg') }}" alt="I" class="img-fluid {{ $totalEarnings < 1 ? 'down-arrw' : ''}}">
        </div>

        <h4>€{{ number_format($totalEarnings) }} </h4>
        <p>Total Earning</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid {{ $todayEarnings < 1 ? 'down-arrw' : ''}}">
        </div>

        <h4>€{{ number_format($todayEarnings) }} </h4>
        <p>Earning Today</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-03.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-03.svg') }}" alt="I" class="img-fluid {{ $totalCurrentPayment < 1 ? 'down-arrw' : ''}}">
        </div>

        <h4>€{{ number_format($totalCurrentPayment) }} </h4>
        <p>Total Customer Payment</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid {{ $totalDueAmount < 1 ? 'down-arrw' : ''}}">
        </div>
        
        <h4>€{{ number_format($totalDueAmount) }} </h4>
        <p>Total Due Amount</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-01.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-01.svg') }}" alt="I" class="img-fluid {{ $todayDueAmount < 1 ? 'down-arrw' : ''}}">
        </div>

        <h4>€{{ number_format($todayDueAmount) }}</h4>
        <p>Today Due Amount</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid {{ $totalFrozenAmount < 1 ? 'down-arrw' : ''}}">
        </div>

        <h4>€{{ number_format($totalFrozenAmount) }}</h4>
        <p>Total Expired Amount</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-10.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-08.svg') }}" alt="I" class="img-fluid {{ $totalNewCompany < 1 ? 'down-arrw' : ''}}">
        </div>
        
        <h4><i class="fas fa-users" style="font-size:1.25rem"></i> {{ number_format($totalNewCompany) }}</h4>
        <p>New Company</p>
      </div>
    </div>
    <!-- card item end -->
    <!-- card item start -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
      <div class="analytics-card-box">
        <div class="top">
          <img src="{{ asset('/public/assets/images/icons/anlytic-11.svg') }}" alt="I" class="img-fluid">
          <img src="{{ asset('/public/assets/images/icons/arrow-up-05.svg') }}" alt="I" class="img-fluid {{ $totalFrozenAccount < 1 ? 'down-arrw' : ''}}">
        </div>
        
        <h4> <i class="fas fa-users" style="font-size:1.25rem"></i> {{ number_format($totalFrozenAccount) }}</h4>
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
            <h5>{{ number_format($totalProducts)}}</h5>
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
          @foreach ($topActiveCompanyUsers->slice(0,5) as $index => $activeCompanyUser)
          @if ($activeCompanyUser->personalInfo)
          <!-- user one start -->
          <div class="media">

            @if ($activeCompanyUser->personalInfo)
              <img src="{{ optional($activeCompanyUser->personalInfo)->avatar }}" alt="A" class="img-fluid">
            @else 
              <span class="no-avatar nva-sm me-3" style="width: 2.75rem; height: 2.75rem;">
                {!! strtoupper($activeCompanyUser->name[0]) !!}</span>
            @endif
 

            @if ($activeCompanyUser->personalInfo)
            <div class="media-body">
              <h5><a href="{{ route('company.show', $activeCompanyUser->company) }}">{{ $activeCompanyUser->name }}</a></h5>
              <p>{{ $activeCompanyUser->email }}</p>
            </div> 
            @endif 

            @if ($index == 0)
            <img src="{{ asset('/public/assets/images/icons/trophy-01.svg') }}" alt="T" class="img-fluid">
            @elseif ($index == 1)
                <img src="{{ asset('/public/assets/images/icons/trophy-02.svg') }}" alt="T" class="img-fluid">
            @else
                <img src="{{ asset('/public/assets/images/icons/trophy-03.svg') }}" alt="T" class="img-fluid">
            @endif 
          </div>
          <!-- user one end --> 
          @endif
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
    data: {!! $eraningGraph !!}
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
    return ((value / total) * 100).toFixed(2) + "%";
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
 
 const data = @json($getActiveInActiveUsers); 

  var options = {
  series: [{
    name: 'active',
    data: data.active_users
  }, {
    name: 'inactive',
    data: data.inactive_users
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
