<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePurchaseRequest extends FormRequest
{
    /**
     * El usuario siempre tiene permiso, no hay validación aquí.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para la petición POST. Aqui se pide que
     * se entreguen los campos necesarios para crear la compra y se verifica
     * que el usuario y el ticket existan en el sistema.
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

    /*
     * Esto transforma los campos recibidos con convención camelCase a la convención
     * snake_case con la que trabaja la base de datos.
     */
    protected function prepareForValidation() {
        $this->merge([
            'customer_id' => $this->customerId,
            'ticket_id' => $this->ticketId,
            'creation_time' => $this->creationTime,
            'payment_time' => $this->paymentTime
        ]);
    }
}
