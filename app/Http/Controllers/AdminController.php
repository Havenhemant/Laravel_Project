<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
   
    public function index()
{
    $users = \App\Models\User::where('role', 'user')->count();
    $queries = \App\Models\Post::count();
    $products = \App\Models\Product::count();
    $orders = \App\Models\Order::count();
    $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
    $totalRevenue = \App\Models\Order::where('status', 'approved')->sum('total_amount');

    $lowStockProducts = \App\Models\Product::whereColumn('stock', '<=', 'reorder_level')->get();

    $topProducts = \App\Models\OrderItem::select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_qty'))
        ->with('product')
        ->groupBy('product_id')
        ->orderByDesc('total_qty')
        ->take(5)
        ->get();

    $ordersPerDay = \App\Models\Order::select(\Illuminate\Support\Facades\DB::raw('DATE(created_at) as date'), \Illuminate\Support\Facades\DB::raw('COUNT(*) as total'))
        ->where('created_at', '>=', now()->subDays(6)->startOfDay())
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $chartLabels = [];
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $chartLabels[] = now()->subDays($i)->format('d M');
        $match = $ordersPerDay->firstWhere('date', $date);
        $chartData[] = $match ? $match->total : 0;
    }

    return view('admin.dashboard', compact(
        'users', 'queries', 'products', 'orders', 'pendingOrders', 'totalRevenue',
        'lowStockProducts', 'topProducts', 'chartLabels', 'chartData'
    ));
}
   

    public function users()
    {
        return view('admin.users', [
            'users' => User::latest()->get()
        ]);
    }

    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user->update($request->only('username', 'email', 'role'));

        return redirect()->route('admin.users')->with('success', 'User updated');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }

    

    // ---------- CONTACT QUERIES ----------

    public function queries()
    {
        return view('admin.queries', [
            'queries' => Post::with('user')->latest()->get()
        ]);
    }

    public function resolveQuery(Post $post)
    {
        $post->update(['status' => 'resolved']);
        return back()->with('success', 'Query marked as resolved');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Query deleted');
    }
    // ---------- PRODUCTS ----------

    public function products()
    {
        return view('admin.products', [
            'products' => Product::latest()->get()
        ]);
    }

    public function createProduct()
    {
        return view('admin.add-product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
    'name'          => 'required|string|max:255',
    'category'      => 'nullable|string|max:255',
    'description'   => 'nullable|string',
    'price'         => 'required|numeric|min:0.01',
    'stock'         => 'required|integer|min:0',
    'reorder_level' => 'required|integer|min:0',
    'image'         => 'nullable|image|max:2048',
]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
    'admin_id'      => auth()->id(),
    'name'          => $request->name,
    'category'      => $request->category,
    'description'   => $request->description,
    'price'         => $request->price,
    'stock'         => $request->stock,
    'reorder_level' => $request->reorder_level,
    'image'         => $imagePath,
]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully');
    }

    public function editProduct(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
      $request->validate([
    'name'          => 'required|string|max:255',
    'category'      => 'nullable|string|max:255',
    'description'   => 'nullable|string',
    'price'         => 'required|numeric|min:0.01',
    'stock'         => 'required|integer|min:0',
    'reorder_level' => 'required|integer|min:0',
    'image'         => 'nullable|image|max:2048',
]);

$data = $request->only('name', 'category', 'description', 'price', 'stock', 'reorder_level');
     

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }
    public function orders()
    {
        return view('admin.orders', [
            'orders' => Order::with(['customer', 'items.product'])->latest()->get()
        ]);
    }

    public function approveOrder(Order $order)
    {
        $order->update(['status' => 'approved']);
        return back()->with('success', 'Order approved');
    }

    public function declineOrder(Order $order)
    {
      
        foreach ($order->items as $item) {
            $item->product?->increment('stock', $item->quantity);
        }

        $order->update(['status' => 'declined']);
        return back()->with('success', 'Order declined');
    }
    public function analytics()
{
 
    $totalRevenue = Order::where('status', 'approved')->sum('total_amount');
    $totalOrders = Order::count();
    $pendingOrders = Order::where('status', 'pending')->count();


    $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'))
        ->with('product')
        ->groupBy('product_id')
        ->orderByDesc('total_qty')
        ->take(5)
        ->get();


    $ordersPerDay = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
        ->where('created_at', '>=', now()->subDays(6)->startOfDay())
        ->groupBy('date')
        ->orderBy('date')
        ->get();

 
    $chartLabels = [];
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $chartLabels[] = now()->subDays($i)->format('d M');
        $match = $ordersPerDay->firstWhere('date', $date);
        $chartData[] = $match ? $match->total : 0;
    }

    return view('admin.analytics', compact(
        'totalRevenue', 'totalOrders', 'pendingOrders', 'topProducts', 'chartLabels', 'chartData'
    ));
}
}