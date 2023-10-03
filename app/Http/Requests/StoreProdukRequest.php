<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use Exception;
use Illuminate\Database\QueryExpection;
use Illuminate\Foundation\Http\FormRequest;
use PDOException;


class StoreProdukRequest extends FormRequest
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
            'nama_produk' => 'required'
        ];
    }

    public function messages(){
            return [
                'nama_produk.required' => 'Data nama produk belum di isi!'
            ];
        }

        public function store(StoreProdukRequest $request)
        {
        try {
            DB::beginTransaction();
            Produk::create($request->all());

            DB:commit();

            return redirect('produk')->with('succes', "input data berhasi");

        }catch (QueryExceptain | Exception | PDOException $error){ 
            DB::rollBack();
            $this->failResponse($error->getMessege(), $error-> getCde());
        }

    }
}