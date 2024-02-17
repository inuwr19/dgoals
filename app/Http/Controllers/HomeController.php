<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['total'] = 0;
    $data['order'] = Order::with('order_product')->where('status', 'paid')->orderByDesc('created_at')->get();

    foreach ($data['order'] as $item) {
        $data['total'] += $item->total;
    }

    $dailySales = Order::selectRaw('SUM(total) as total, DATE(created_at) as date')
        ->where('status', 'paid')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $data['dailySales'] = $dailySales->pluck('total');
    $data['dates'] = $dailySales->pluck('date');

    $chartData = [
        'labels' => $data['dates'],
        'datasets' => [
            [
                'label' => 'Daily Sales',
                'data' => $data['dailySales'],
                'fill' => false,
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 2,
            ],
        ],
    ];

        if (auth()->user()->hasRole('admin')) {
            return view('home', $data , compact('data', 'chartData'));
        } else {
            return redirect()->route('index');
        }
    }

    public function formAdmin()
    {
        return view('admin.formAdmin');
    }
    public function addProd(Request $request)
    {
        $data = new Product;

        if($thumbnail=$request->file('img')){
            $destinationPath = 'product/';
            $nameImage = $request->nameProd.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath,$nameImage);
            $data->thumbnail = $nameImage;
        }

        $data->name = $request->nameProd;
        $data->category_id = $request->catProd;
        $data->price = $request->priceProd;
        $data->desc = "Ekpresikan gaya terbaikmu selalu dengan hal yang positif. Sepatu MONARC siap mengawal hari positifmu,
        didesain oleh material pelapis yang lembut dan nyaman saat dipakai karena adanya teknologi Quickfit dan Ortflow
        membuat sepatu ini makin sempurna untukmu. Teknologi Cumulus Foam dan Ortshox membuat sepatu ini sangat ringan dan
        mengikuti kontur kaki saat dipakai. Sepatu ini bermaterial Sandwich, Knitting, PU Nosew, Compression Phylon, dan
        EVA. Hi #TeamOrtuseight. KETENTUAN BERBELANJA DI ORTUSEIGHT OFFICIAL SHOP : 1. Ketersediaan STOK
        sesuai dengan yang tertera di halaman produk. 2. Pembelian akan di proses 2x24 jam tidak termasuk Sabtu, Minggu,
        dan hari libur nasional. 3. Pembelian tidak dapat DIBATALKAN, DIKEMBALIKAN atau UBAH WARNA / MODEL / UKURAN atas
        alasan apapun kecuali kesalahan penjual yang salah mengirimkan barang atau barang yang diterima cacat. 4. Pegajuan
        komplain harus disertakan video unboxing saat barang diterima. 5. Operasional chat Senin-Jumat jam 09:00-15:00.
        Sabtu, Minggu dan hari libur nasional TUTUP. Dengan melakukan pembelian berarti pembeli telah setuju dengan
        ketentuan tersebut. Selamat berbelanja.";

        $data->save();
        return redirect()->back();
    }
}
