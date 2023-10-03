<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_barang' => 'required'
        ];
    }

    public function messages(){
        return [
            'nama.required' => 'Data nama barang belum di isi!'
        ];
    }

        public function store(StoreBarangRequest $request)
        {
        try {
            DB::beginTransaction();
            Produk::create($request->all());

            DB:commit();

            return redirect('barang')->with('succes', "input data berhasi");

        }catch (QueryExceptain | Exception | PDOException $error){ 
            DB::rollBack();
            $this->failResponse($error->getMessege(), $error-> getCode());
        }

    }
}
