<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Category::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('kode', 'nama')->orderBy('id')->get();

        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }
    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = Category::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('categories.form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = Category::where('kode', $kode)->first();
        return view('categories.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $data_item = new Category;
            $kode = Category::count('id');
            $kode = $kode + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            sleep(3);
        } else {
            $data_item = Category::find($id);
            $kode = $data_item->kode;
        }

        $data_item->nama = $request->nama;
        $data_item->kode = $kode;
        $data_item->save();

        return redirect('categories');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect('categories');
    }

    public function downloadPdf($kode)
    {
        $category = Category::with('masterItems')
            ->where('kode', $kode)
            ->firstOrFail();
    
        $pdf = Pdf::loadView('categories.single.pdf', [
            'data' => $category
        ]);
    
        return $pdf->download(
            'kategori-' . $category->kode . '.pdf'
        );
    }
}
