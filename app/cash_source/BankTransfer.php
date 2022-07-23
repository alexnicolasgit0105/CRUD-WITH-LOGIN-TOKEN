<?php

namespace App\Cash_Source;

use App\cash_source\Transaction;
use Illuminate\Http\Request;

use App\Models\Transaction as TransactionModel;

class BankTransfer implements Transaction
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
            'acc_no'     =>  ['alpha_num', 'required','digits:6'],
            'tranfer_date'     => ['required',
                function ($attribute, $value, $fail) {
                    $current_date = date("Y-m-d");
                    if ($value < $current_date) {
                        $fail("Transfer Date can’t be older than current date!");
                    }
                }
            ],
            'customer'     => ['required'],
            'amount'     => ['integer','required','lte:20000'],
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