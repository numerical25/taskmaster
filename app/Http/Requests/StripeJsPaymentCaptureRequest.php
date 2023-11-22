<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripeJsPaymentCaptureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'id'=>'required:string',
            'client_secret'=>'string'
        ];
    }
    public function id() {
        return $this->get('id');
    }
    public function client_secret() {
        return $this->get('client_secret');
    }
}
