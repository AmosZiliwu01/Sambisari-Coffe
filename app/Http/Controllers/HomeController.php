<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Page;
class HomeController extends Controller
{
    public function index()
    {
        #halaman awal
        $products = Product::all();
        $menu = $this->getMenu();
        $product = Product::with('kategori')->latest()->get()->take(8);
        $mostViews = Product::with('kategori')->orderByDesc('total_views')->get()->take(3);
        return view('frontend.content.home', compact('menu','product','mostViews','products'));
    }

    public function detailProduct($id)
    {
        #halaman detail Product
        $menu = $this->getMenu();
        $product = Product::findOrFail($id);

        #update total_views
        $product->total_views = $product->total_views + 1;
        $product->save();
        return view('frontend.content.detailProduct', compact('menu','product'));
    }

    public function detailPage($id)
    {
        #halaman detail page
        $menu = $this->getMenu();
        $page = Page::findOrFail($id);
        return view('frontend.content.detailPage', compact('menu','page'));
    }

    public function semuaProduct()
    {
        #halaman menampilkan seluruh data product
        $menu = $this->getMenu();
        $product = Product::with('kategori')->latest()->get();
        return view('frontend.content.SemuaProduct', compact('menu','product'));

    }

    private function getMenu()
    {
        $menu = Menu::whereNull('parent_menu')
            ->with(['submenu'=> fn($q) => $q->where('status_menu','=',1)->orderBy('urutan_menu','asc')])
            ->where('status_menu','=',1)
            ->orderBy('urutan_menu','asc')
            ->get();

        $dataMenu = [];
        foreach ($menu as $m) {
            $jenis_menu = $m->jenis_menu;
            $urlMenu = $m->url_menu;

            if ($jenis_menu == "url"){
                $urlMenu = $m->url_menu;
            }else{
                $urlMenu = route('home.detailPage',$m->url_menu);
            }

            #itemMenu
            $dItemMenu = [];
            foreach ($m->submenu as $im) {
                $jenisItemMenu = $im->jenis_menu;
                $urlItemMenu = "";

                if ($jenisItemMenu == "url"){
                    $urlItemMenu = $im->url_menu;
                }else{
                    $urlItemMenu = route('home.detailPage',$im->url_menu);
                }

                $dItemMenu[] = [
                    'sub_menu_nama' => $im->nama_menu,
                    'sub_menu_target' => $im->target_menu,
                    'sub_menu_url' => $urlItemMenu,
                ];
            }
            $dataMenu[] = [
                'menu' => $m->nama_menu,
                'target' => $m->target_menu,
                'url' => $urlMenu,
                'itemMenu' => $dItemMenu
            ];
        }
        return $dataMenu;
    }
}
