<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildrenRequest extends FormRequest
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
        if(request()->isMethod('post')){
            $nessessary = "required";
        }elseif(request()->isMethod('put')){
            $nessessary = "sometimes";
        }
        return [
            'name'=> [$nessessary,'string','unique:Childrens,name'],
            'birthdate'=> [$nessessary,'date'],
            'gender'=> [$nessessary,'boolean']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.unique' => 'name is already Exists',
            'birthdate.required' => 'A birthdate is required',
            'gender.required' => 'A gender is required',
        ];
    }
}
