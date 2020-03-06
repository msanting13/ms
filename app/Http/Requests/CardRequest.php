<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CardRequest extends FormRequest
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
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'card_name' =>  ['required', Rule::unique('cards')->where(function ($query) use ($request){
                                return $query->where('fiscal_year', $request->fiscal_year)->where('type', $request->type);
            })],
            'type'          =>  ['required'],
            'fiscal_year'   =>  ['required'],
            'description'   =>  ['required','min:4'],
            'message'       =>  ['required','min:4']
        ];
    }
    public function messages()
    {
        return [
            'type.required'          =>  'Report for field is required.',
            'card_name.unique'      =>  'Report is already exist.',
            'card_name.required'    =>  'Report type field is required.',
            'message.required'      =>  'Remark field is required.',
            'message.min'           =>  'The remark must be at least 4 characters.'
        ];
    }
}
