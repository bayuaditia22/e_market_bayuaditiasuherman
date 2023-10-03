<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Produk;
use App\Http\Requests;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\StoreProduksRequest;
use App\Http\Requests\UpdateBarangRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PDOException;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $produk = Produk::all();
        try{
            $data['barang'] = Barang::orderBy('created_at', 'DESC')->get();
            $data['produks'] = Produk::orderBy('created_at', 'DESC')->get();

            return view('barang.index',compact('produk'))->with($data);
        }
        catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        // return $r;
        Barang::create($request->all());

        return redirect('barang')->with('success', 'Data barang berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());
        return redirect('barang')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect('barang')->with('success','Data barang berhasil dihapus!'); 
    }
}
