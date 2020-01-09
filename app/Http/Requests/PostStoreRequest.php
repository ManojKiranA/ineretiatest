<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'default';
    
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
            'post_name' => ['required','string','max:100',"unique:\App\Post"],
            'post_description' => ['required','string','max:20000'],
            'user_id' => ['required'],
        ];
    }
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'post_name' => 'Post Name',
            'post_description' => 'Post Description',
            'user_id' => 'User Name',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'post_name.required' => 'The :attribute is required.',
            'post_description.required' => 'The :attribute is required.',
        ];
    }
}
