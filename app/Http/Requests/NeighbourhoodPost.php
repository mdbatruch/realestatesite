<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NeighbourhoodPost extends FormRequest
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
        return [
            'neighbourhoods.*.name' => 'required|max:128',
            'neighbourhoods.*.subtitle' => 'required|max:512',
            'neighbourhoods.*.description' => 'required|min:0',
            'neighbourhoods.*.image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'neighbourhoods.*.name.required' => 'The name field is required.',
            'neighbourhoods.*.subtitle.required' => 'The subtitle field is required.',
            'neighbourhoods.*.description.required' => 'The description field is required.',
            'neighbourhoods.*.image.required' => 'The image field is required.',
        ];
    }
}
