<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HousePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->can('edit-house');
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
            // $request->validate([
                'name' => 'required|max:128',
                'description' => 'required|max:512',
                'price' => 'required|numeric|min:0',
                'neighbourhood' => 'required|numeric',
                'propertyType' => 'required',
                'image' => 'required'
            // ])
        ];
    }
}
