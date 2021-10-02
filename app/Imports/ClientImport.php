<?php

namespace App\Imports;

use App\Client;
use App\Models\Admin\AdminClient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientImport implements ToModel, WithHeadingRow
{
    protected $count=0;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

//        dd($this->count);
//        $row=array_filter($row);


        if (!isset($row['name'])&&!isset($row['company_name'])&&!isset($row['city'])&&!isset($row['city'])&&!isset($row['state'])&&!isset($row['email'])&&!isset($row['industry'])&&!isset($row['job_title']))
        {
            return null;
        }
        else if (!isset($row['name'])||!isset($row['company_name'])||!isset($row['city'])||!isset($row['city'])||!isset($row['state'])||!isset($row['email'])||!isset($row['industry'])||!isset($row['job_title']))
        {
            session(['client_skipped'=>'Null Values']);
            return null;
        }





        try
        {
            $check = AdminClient::where('email',$row['email'])->exists();
            if (!$check)
            {
                return new AdminClient([
                    'name'  => $row['name'],
                    'company_name' => $row['company_name'],
                    'city' => $row['city'],
                    'state' => $row['state'],
                    'email' => $row['email'],
                    'industry' => $row['industry'],
                    'job_title' => $row['job_title'],
                    'phone' => -1,
                    'recruitment_pipeline' => 0,

                    //
                ]);
            }
            else
            {
//                session(['duplicate'=>'File has some duplicate entries']);
//                dd(session()->get('duplicate'));
            }

        }
        catch (Throwable $e)
       {
//           $e->getMessage() ;
            report($e);
//
//            return $e;
       }

    }
}
