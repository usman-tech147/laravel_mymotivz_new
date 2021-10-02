<?php

namespace App\Imports;

use App\Job;
use App\Models\Admin\AdminJob;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['city'])&&!isset($row['state'])&&!isset($row['industry'])&&!isset($row['job_requirements'])&&!isset($row['salary'])&&!isset($row['job_title'])) {
//            print_r($row['name']);
            return null;
        }
        else if (!isset($row['city'])||!isset($row['state'])||!isset($row['industry'])||!isset($row['job_requirements'])||!isset($row['salary'])||!isset($row['job_title'])) {
//            print_r($row['name']);
            session(['job_skipped'=>'Null Values']);
            return null;
        }
        try
        {
                return new AdminJob([

                    'city' => $row['city'],
                    'state' => $row['state'],
                    'industry' => $row['industry'],
                    'job_discription' => $row['job_requirements'],
                    'package' => $row['salary'],
                    'jobtitle' => $row['job_title'],
                    'service' => 'N/A',
                    'admin_client_id' => 50,
                    'recruitment_pipeline' => 0,
                    //
                ]);


        }
        catch (Throwable $e)
        {
            report($e);

            return $e;
        }
    }
}
