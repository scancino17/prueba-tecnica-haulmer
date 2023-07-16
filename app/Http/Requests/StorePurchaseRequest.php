<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePurchaseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'customerId' => ['required', 'exists:customers,id'],
            'status' => ['required', Rule::in(['creado', 'pagado', 'cancelado'])],
            'ticketId' => ['required', 'exists:tickets,id']
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'customer_id' => $this->customerId,
            'ticket_id' => $this->ticketId,
            'creation_time' => $this->creationTime,
            'payment_time' => $this->paymentTime
        ]);
    }
}
