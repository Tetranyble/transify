<?php

namespace App\Http\Requests;

use App\Models\TransactionType;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{

    public function passedValidation()
    {
        $ttype = TransactionType::whereName($this->type)->first();
        $this->merge([
            'user_id' => auth()->user()->id,
            'account_id' => auth()->user()->accounts()->first()->id,
            'transaction_type_id' => $ttype->id,

        ]);
    }


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
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'receiver' => 'nullable|numeric'
        ];
    }
}
