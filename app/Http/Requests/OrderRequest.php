<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'product.*' => [
                'required', 
                'distinct', 
                Rule::exists('products', 'id')
            ]
        ];

        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'order_id' => 'required|integer|exists:orders,id',
                    'sum' => [
                        'required',
                        "OrderSum:{$this->get('order_id')}",
                        "OrderNew:{$this->get('order_id')}",
                    ],
                ];
        }
    }

}
