<x-layout>

<h1 class="text-2xl font-bold mb-6">Sales Analytics</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-slate-800 p-4 rounded">
        <p class="text-slate-400 text-sm">Total Revenue (Approved Orders)</p>
        <p class="text-2xl font-bold text-green-400">${{ number_format($totalRevenue, 2) }}</p>
    </div>
    <div class="bg-slate-800 p-4 rounded">
        <p class="text-slate-400 text-sm">Total Orders</p>
        <p class="text-2xl font-bold">{{ $totalOrders }}</p>
    </div>
    <div class="bg-slate-800 p-4 rounded">
        <p class="text-slate-400 text-sm">Pending Orders</p>
        <p class="text-2xl font-bold text-yellow-400">{{ $pendingOrders }}</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">

    <div class="bg-slate-800 p-4 rounded">
        <h2 class="font-semibold mb-3">Orders (Last 7 Days)</h2>
        <canvas id="ordersChart"></canvas>
    </div>

    <div class="bg-slate-800 p-4 rounded">
        <h2 class="font-semibold mb-3">Top 5 Selling Products</h2>
        <canvas id="topProductsChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ordersCtx = document.getElementById('ordersChart');
    new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Orders',
                data: {!! json_encode($chartData) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { labels: { color: '#e2e8f0' } } },
            scales: {
                x: { ticks: { color: '#94a3b8' } },
                y: { ticks: { color: '#94a3b8' }, beginAtZero: true }
            }
        }
    });

    const topCtx = document.getElementById('topProductsChart');
    new Chart(topCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topProducts->pluck('product.name')) !!},
            datasets: [{
                label: 'Units Sold',
                data: {!! json_encode($topProducts->pluck('total_qty')) !!},
                backgroundColor: '#22c55e'
            }]
        },
        options: {
            plugins: { legend: { labels: { color: '#e2e8f0' } } },
            scales: {
                x: { ticks: { color: '#94a3b8' } },
                y: { ticks: { color: '#94a3b8' }, beginAtZero: true }
            }
        }
    });
</script>

</x-layout>