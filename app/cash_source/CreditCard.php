<?php

namespace App\Cash_Source;

use App\cash_source\Transaction;
use Illuminate\Http\Request;
use App\Models\Transaction as TransactionModel;

class CreditCard implements Transaction
{
    private $id;

    public function inputs($request)
    {
        $Transaction = new TransactionModel();

        $Transaction->total_amount  = $request->all()['amount'];
        $Transaction->inputs  = json_encode($request->all());

        try {
            $response = $Transaction->save();
            $this->id = $Transaction->id;
            return [
                'status' => true,
                'data'    => self::amount()
            ];
        } catch (\Illuminate\Database\QueryException $ex) {
            return [
                'status' => false,
                'message' => $ex->getMessage()
            ];
        }
    }

    public function validate($amount)
    {
        $validated = $amount->validate([
            'card_no'     =>  ['integer', 'regex:/^[4]{1}[0-9]+$/', 'required', 'digits:16'],
            'exp_date'     => ['required',
                function ($attribute, $value, $fail) {
                    $current_date = $date = date("Y-m-d", strtotime("+2 months"));
                    if ($value < $current_date) {
                        $fail($attribute . " must be greater than 2 months!");
                    }
                }
            ],
            'holder'     => ['required'],
            'cvv'          => ['integer', 'required', 'digits:3'],
            'amount'     => ['integer', 'required', 'lte:20000'],
        ]);
    }

    public function amount()
    {

        $response = TransactionModel::where([
            'id' => $this->id,
        ])->get()->toArray();
        return $response[0];
    }
}