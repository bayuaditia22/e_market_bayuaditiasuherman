<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PembelianImport;
use App\Exports\PembelianExport;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Pemasok;
use App\Models\Barang;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new PembelianExport, $date.'_pembelian.xlsx');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //try{
            //$data['pembelian'] = pembelian::get();
            //return view('pembelian.index')->with($data);
        //}
        //catch (QueryException | Exception | PDOException $error) {
            //$this->failResponse($error->getMessage(), $error->getCode());
        //}

        $lastId = Pembelian::select('kode_masuk')->orderBy('created_at','desc')->first();
        $data['kode'] = ($lastId== null?'P00000001':sprintf('P%08d', substr
        ($lastId->kode_masuk,1)+1));
        $data['pemasok'] = Pemasok::get();
        $data['barang'] = Barang::get();
       
        return view('pembelian/index')->with($data);
    }

    public function history()
    {
        $data['pembelian'] = DB::table('pembelian')
            ->join('pemasok', 'pembelian.pemasok_id', '=', 'pemasok.id')
            ->join('users', 'pembelian.user_id', '=', 'users.id')
            ->select('pembelian.*', 'pemasok.nama_pemasok', 'users.name')
            ->get();
        return view('pembelian/history')->with($data);
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
     * @param  \App\Http\Requests\StorePembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePembelianRequest $request)
    {
        //Pembelian::create($request->all());

        //return redirect('pembelian')->with('success', 'Data pemasok berhasil di tambahkan!');
        //input pembelian
        $data['kode_masuk'] = $request['kode_masuk'];
        $data['tanggal_masuk'] = $request['tanggal_masuk'];
        $data['totalHarga'] = $request['totalHarga'];
        $data['pemasok_id'] = $request['pemasok_id'];
        $data['user_id'] = 1;

        $input_pembelian = Pembelian::create($data);

        //input detail pembelian
        $barang_id = $request->barang_id;
        $harga_beli = $request->harga_beli;
        $jumlah = $request->jumlah;
        $sub_total = $request->sub_total;

        foreach( $barang_id as $i =>$v){
            $data2['pembelian_id'] = $input_pembelian->id;
            $data2['barang_id'] = $barang_id[$i];
            $data2['harga_beli'] = $harga_beli[$i];
            $data2['jumlah'] = $jumlah[$i];
            $data2['sub_total'] = $sub_total[$i];
            $input_detail_pembelian = DetailPembelian::create($data2);
        }
        return redirect('pembelian')->with('success','input berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePembelianRequest  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePembelianRequest $request, Pembelian $pembelian)
    {
        $pembelian->update($request->all());
        return redirect('pembelian')->with('success', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();
        return redirect('pembelian')->with('success','Data produk berhasil dihapus!'); 
    }
}
