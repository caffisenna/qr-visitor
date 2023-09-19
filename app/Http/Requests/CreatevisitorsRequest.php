<?php

namespace App\Http\Requests;

use App\Models\visitors;
use Illuminate\Foundation\Http\FormRequest;

class CreatevisitorsRequest extends FormRequest
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
    public function rules()
    {
        $rules = visitors::$rules;
        $input = $this->all();
        $input['booth_number'] = str_replace('booth', '', $input['booth_number']);
        $this->replace($input);



        return visitors::$rules;
    }
}
