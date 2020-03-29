<?php

namespace App\Http\Controllers;
use App\Transaction;
use App\Investor;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemActionController extends Controller
{
    public function sendEmails()
    {
        //TODO
        //GET ALL CLIENT TRANSACTIONS
        $investor_transactions = array();
        $investors = Investor::all();
        foreach ($investors as $investor) {
            $transactions = Transaction::with('product')->where('investor_id','=',$investor->id)->get();
            $investData = array('email'=>$investor->email,'transactions' => $transactions );

            array_push($investor_transactions, $investData);
        }
        $this->generateClientStatement($investor_transactions);
        // dd($investor_transactions);
        //GENERATE FORMATTED EMAIL FOR CLIENTS
        //ADD TRANSACTIONS TO EMAIL DB
        //SEND EMAILS
        //UPDATE FRONT END WITH EMAIL COUNT
        return response()
            ->json(['status' => 'success', 'Investors' => $investors->count()]);


    }

    public function generateClientStatement($investor_transactions)
    {
        for ($i=0; $i < count($investor_transactions); $i++) {
            $netCredit = 0;
                $netDebit = 0;
                $statement = '';
                $email = $investor_transactions[$i]['email'];
            foreach ($investor_transactions[$i]['transactions'] as $investor_transaction) {
                // dd($investor_transaction);
                // foreach ($investor_transaction as $transaction) {
                    if ($investor_transaction->investment_type == 'credit') {
                        $netCredit += $investor_transaction->amount;
                        $statement .="<tr><td></td><td>".$investor_transaction->amount."</td></tr>";
                    }
                    if ($investor_transaction->investment_type == 'debit') {
                        $netDebit += $investor_transaction->amount;
                        $statement .="<tr><td>".$investor_transaction->amount."</td><td></td></tr>";
                    }
                
               
            }
             $finalstatement = $this->addStatementToEmailTable($email,$netDebit, $netCredit, $statement);

        }
        
    }
    public function addStatementToEmailTable($email,$netDebit, $netCredit, $statement)
    {
        //Prevent double entry tobe done later
        // dd($email);
        $netInvestment = $netDebit-$netCredit;
        $finalstatement = '
            <!DOCTYPE html>
            <html>
            <head>
                <title></title>
            </head>
            <body>
                <table>
                <caption>Cytonn Client statement</caption>
                <thead>
                    <tr>
                        <th>Debits</th>
                        <th>Credits</th>
                        <th>Net Debits</th>
                        <th>Net Credits</th>
                        <th>Total Investment</th>
                    </tr>
                </thead>
                <tbody>
                    
                        '.$statement.'

                    <tr>
                    <td></td>
                    <td></td>
                    <td>'.$netDebit.'</td>
                    <td>'.$netCredit.'</td>
                    <td>'.$netInvestment.'</td>
                    </tr>
                </tbody>
            </table>
            </body>
            </html>            
        ';
        DB::table('emails')->insert(
            [
                'user_email' => $email,
                'email_body' => $finalstatement,
                'status' => '0',
            ]
        );
        return true;
    }
}
