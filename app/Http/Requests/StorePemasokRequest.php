<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
   
class StorePemasokRequest extends FormRequest
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
           
            'nama_pemasok' => 'required'
        
        ];
    }

    public function messages(){
        return [
            'nama.required' => 'Data nama pemasok belum di isi!'
        ];
    }

        public function store(StorePemasokRequest $request)
        {
        try {
            DB::beginTransaction();
            Pemasok::create($request->all());

            DB:commit();

            return redirect('pemasok')->with('succes', "input data berhasi");

        }catch (QueryExceptain | Exception | PDOException $error){ 
            DB::rollBack();
            $this->failResponse($error->getMessege(), $error-> getCde());
        }

    }
}
