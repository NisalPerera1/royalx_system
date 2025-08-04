@extends('layouts.admin_includes.app')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Loan Management</h3>
                        </div>
                    </div>
                </div>

                {{-- Loan Summary Cards --}}
                <div class="row gy-4">
    <div class="col-md-3">
        <div class="card card-bordered">
            <div class="card-inner text-center">
                <h5 class="title">Today’s Loans</h5>
                <h3>Rs. {{ number_format($dailyLoanAmount, 2) }}</h3>
                <span class="text-muted">{{ $dailyLoanCount }} issued</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-bordered">
            <div class="card-inner text-center">
                <h5 class="title">This Week</h5>
                <h3>Rs. {{ number_format($weeklyLoanAmount, 2) }}</h3>
                <span class="text-muted">{{ $weeklyLoanCount }} issued</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-bordered">
            <div class="card-inner text-center">
                <h5 class="title">This Month</h5>
                <h3>Rs. {{ number_format($monthlyLoanAmount, 2) }}</h3>
                <span class="text-muted">{{ $monthlyLoanCount }} issued</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-bordered">
            <div class="card-inner text-center">
                <h5 class="title">This Year</h5>
                <h3>Rs. {{ number_format($yearlyLoanAmount, 2) }}</h3>
                <span class="text-muted">{{ $yearlyLoanCount }} issued</span>
            </div>
        </div>
    </div>
</div>


                {{-- Loan Chart --}}
                <div class="row gy-4 mt-3">
                    <div class="col-md-12">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h6 class="title mb-2">Loan Trends (Last 30 Days)</h6>
                                <canvas id="loanChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


<!-- Pie Charts -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Loan Status Overview</h5>
    </div>
    <div class="card-body d-flex justify-content-center">
        <div style="width: 20%; height: 20%;">
            <canvas id="loanStatusPieChart"></canvas>
        </div>
    </div>
</div>
<!-- End Pie Chart -->




                {{-- Recent Loans --}}
                <div class="row gy-4 mt-3">
                    <div class="col-md-12">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h6 class="title mb-3">Recent Loans</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Client</th>
                                            <th>Amount</th>
                                            <!-- <th>Start Date</th> -->
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentLoans as $loan)
                                            <tr>
                                                <td>{{ $loan->client->name }}</td>
                                                <td>Rs. {{ number_format($loan->loan_amount, 2) }}</td>
                                                <!-- <td>{{ optional($loan->start_date)->format('Y-m-d') ?? '-' }}</td> -->
                                                <td>{!! $loan->status_badge !!}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center">No recent loans</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- nk-content-body --}}
        </div> {{-- nk-content-inner --}}
    </div> {{-- container-fluid --}}
</div> {{-- nk-content --}}
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('loanChart').getContext('2d');
    const loanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($loanChartData->keys()) !!},
            datasets: [{
                label: 'Loan Issued (Rs)',
                data: {!! json_encode($loanChartData->values()) !!},
                backgroundColor: '#6576ff',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rs. ' + value
                    }
                }
            }
        }
    });


// pie chart script
// ✅ FIXED: Use a different variable name for pie chart context
const pieCtx = document.getElementById('loanStatusPieChart').getContext('2d');

const loanStatusData = {
    labels: {!! json_encode($statusBreakdown->keys()) !!},
    datasets: [{
        data: {!! json_encode($statusBreakdown->values()) !!},
        backgroundColor: [
            '#4CAF50', // completed (green)
            '#FFC107', // active (yellow)
            '#F44336', // defaulted (red)
            '#9E9E9E'  // unknown (gray fallback)
        ],
        borderWidth: 1
    }]
};

const config = {
    type: 'pie',
    data: loanStatusData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        let value = context.parsed || 0;
                        return `${label}: ${value}`;
                    }
                }
            }
        }
    },
};

// ✅ Create pie chart using renamed variable
new Chart(pieCtx, config);



</script>
@endsection
