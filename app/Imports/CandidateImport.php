<?php

namespace App\Imports;

use App\Candidate;
use App\Models\Admin\AdminCandidate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CandidateImport implements ToModel , WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd($row);
        if (!isset($row['name'])&&!isset($row['email'])&&!isset($row['city'])&&!isset($row['state'])&&!isset($row['industry'])&&!isset($row['phone_number'])&&!isset($row['skills'])&&!isset($row['employer'])&&!isset($row['job_title'])) {
//            print_r($row['name']);
            return null;
        }
        else if (!isset($row['name'])||!isset($row['email'])||!isset($row['city'])||!isset($row['state'])||!isset($row['industry'])||!isset($row['phone_number'])||!isset($row['skills'])||!isset($row['employer'])||!isset($row['job_title']))
        {
            session(['candidate_skipped'=>'Null Values']);

            return null;
        }
        try
        {
            $check = AdminCandidate::where('email',$row['email'])->exists();
            if (!$check)
            {
//                dd($row['name']);
                return new AdminCandidate([
                    'name'  => $row['name'],
                    'email' => $row['email'],
                    'city' => $row['city'],
                    'state' => $row['state'],
                    'Industry' => $row['industry'],
                    'phone' => $row['phone_number'],
                    'skills' => $row['skills'],
                    'employer' => $row['employer'],
                    'job_title' => $row['job_title'],
                    'interest' => 'N/A',
                    'experience' => -1,
                    'salary' => -1,
                    'education_id' => 15,
                    'admin_status_id' => 60,

                    //
                ]);
//                dd('hdfh');
            }
            else
            {
//                session(['duplicate1'=>'File has some duplicate entries']);
            }

        }
        catch (Throwable $e)
        {
            report($e);

            return $e;
        }
    }
}
