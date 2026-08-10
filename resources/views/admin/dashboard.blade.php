<x-layout>

<div class="mb-6">
    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
    <p class="text-slate-400 text-sm">Overview of your store performance</p>
</div>

{{-- Low Stock Alert --}}
@if($lowStockProducts->count() > 0)
    <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-xl mb-6">
        <p class="font-bold mb-2">⚠ {{ $lowStockProducts->count() }} product(s) need reordering</p>
        <ul class="text-sm list-disc list-inside space-y-0.5">
            @foreach($lowStockProducts as $p)
                <li>{{ $p->name }} — only {{ $p->stock }} left (reorder level: {{ $p->reorder_level }})</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Stat Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

    <div class="bg-gradient-to-br from-green-600/20 to-slate-900 border border-green-500/20 p-4 rounded-xl">
        <p class="text-slate-400 text-xs">Total Revenue</p>
        <p class="text-2xl font-bold text-green-400 mt-1">${{ number_format($totalRevenue, 2) }}</p>
    </div>

    <div class="bg-gradient-to-br from-blue-600/20 to-slate-900 border border-blue-500/20 p-4 rounded-xl">
        <p class="text-slate-400 text-xs">Total Orders</p>
        <p class="text-2xl font-bold text-blue-400 mt-1">{{ $orders }}</p>
    </div>

    <div class="bg-gradient-to-br from-yellow-600/20 to-slate-900 border border-yellow-500/20 p-4 rounded-xl">
        <p class="text-slate-400 text-xs">Pending Orders</p>
        <p class="text-2xl font-bold text-yellow-400 mt-1">{{ $pendingOrders }}</p>
    </div>

    <div class="bg-gradient-to-br from-purple-600/20 to-slate-900 border border-purple-500/20 p-4 rounded-xl">
        <p class="text-slate-400 text-xs">Products</p>
        <p class="text-2xl font-bold text-purple-400 mt-1">{{ $products }}</p>
    </div>

    <div class="bg-gradient-to-br from-pink-600/20 to-slate-900 border border-pink-500/20 p-4 rounded-xl">
        <p class="text-slate-400 text-xs">Customers</p>
        <p class="text-2xl font-bold text-pink-400 mt-1">{{ $users }}</p>
    </div>

    <div class="bg-gradient-to-br from-orange-600/20 to-slate-900 border border-orange-500/20 p-4 rounded-xl">
        <p class="text-slate-400 text-xs">Open Queries</p>
        <p class="text-2xl font-bold text-orange-400 mt-1">{{ $queries }}</p>
    </div>

</div>

{{-- Quick Actions --}}
<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('admin.products') }}" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 text-white rounded-lg transition">📦 Manage Products</a>
    <a href="{{ route('admin.orders') }}" class="bg-orange-600 hover:bg-orange-700 px-4 py-2 text-white rounded-lg transition">🧾 Manage Orders</a>
    <a href="{{ route('admin.queries') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 text-white rounded-lg transition">✉️ Manage Queries</a>
    <a href="{{ route('admin.users') }}" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 text-white rounded-lg transition">👥 Manage Users</a>
</div>

{{-- Charts --}}
<div class="grid md:grid-cols-2 gap-6">

    <div class="bg-slate-900 border border-slate-800 p-5 rounded-xl">
        <h2 class="font-semibold mb-3">📈 Orders (Last 7 Days)</h2>
        <canvas id="ordersChart"></canvas>
    </div>

    <div class="bg-slate-900 border border-slate-800 p-5 rounded-xl">
        <h2 class="font-semibold mb-3">🏆 Top 5 Selling Products</h2>
        @if($topProducts->count() > 0)
            <canvas id="topProductsChart"></canvas>
        @else
            <p class="text-slate-400 text-sm">No sales data yet.</p>
        @endif
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
                x: { ticks: { color: '#94a3b8' }, grid: { color: '#1e293b' } },
                y: { ticks: { color: '#94a3b8' }, grid: { color: '#1e293b' }, beginAtZero: true }
            }
        }
    });

    @if($topProducts->count() > 0)
    const topCtx = document.getElementById('topProductsChart');
    new Chart(topCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topProducts->pluck('product.name')) !!},
            datasets: [{
                label: 'Units Sold',
                data: {!! json_encode($topProducts->pluck('total_qty')) !!},
                backgroundColor: '#22c55e',
                borderRadius: 6
            }]
        },
        options: {
            plugins: { legend: { labels: { color: '#e2e8f0' } } },
            scales: {
                x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                y: { ticks: { color: '#94a3b8' }, grid: { color: '#1e293b' }, beginAtZero: true }
            }
        }
    });
    @endif
</script>

</x-layout>