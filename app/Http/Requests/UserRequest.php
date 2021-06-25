<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        if ( Auth::User() != null && is_object(Auth::user()) ) 
        {
            $user_id = Auth::User()->id;
    
            return [
                'name'     => 'required',
                'lastname' => 'required',
                'nick'     => 'required|unique:users,nick,'.$user_id,
                'email'    => 'required|email|unique:users,email,'.$user_id,
                'avatar'   => 'image|mimes:jpeg,png,jpg|dimensions:ratio=1/1',
            ];
        }
        else
        {
            return [
                'name'     => 'required',
                'lastname' => 'required',
                'nick'     => 'required|unique:users',
                'email'    => 'required|email|unique:users',
                'avatar'   => 'image|mimes:jpeg,png,jpg|dimensions:ratio=1/1',
            ];
        }
    }
}
