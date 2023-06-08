<?php

namespace App\Imports;

use App\ImportResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ResultImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportResult([
            'student_name' => $row['student_name'],
            'student_class' => $row['student_class'],
            'no_in_class' => $row['no_in_class'],
            'class_teacher_remarks' => $row['class_teacher_remarks'],
            'head_teacher_remarks' => $row['head_teacher_remarks'],
            'average' => $row['average'],
            'term' => $row['term'],
            'date' => $row['date'],
            'obtained_scores_quran' => $row['obtained_scores_quran'],
            'exams_scores_quran' => $row['exams_scores_quran'],
            'ca_scores_quran' => $row['ca_scores_quran'],
            'cw_scores_quran' => $row['cw_scores_quran'],
            'total_scores_quran' => $row['total_scores_quran'],
            'obtained_scores_arabic' => $row['obtained_scores_arabic'],
            'exams_scores_arabic' => $row['exams_scores_arabic'],
            'ca_scores_arabic' => $row['ca_scores_arabic'],
            'cw_scores_arabic' => $row['cw_scores_arabic'],
            'total_scores_arabic' => $row['total_scores_arabic'],
            'obtained_scores_hadith' => $row['obtained_scores_hadith'],
            'exams_scores_hadith' => $row['exams_scores_hadith'],
            'ca_scores_hadith' => $row['ca_scores_hadith'],
            'cw_scores_hadith' => $row['cw_scores_hadith'],
            'total_scores_hadith' => $row['total_scores_hadith'],
            'obtained_scores_azkar' => $row['obtained_scores_azkar'],
            'exams_scores_azkar' => $row['exams_scores_azkar'],
            'ca_scores_azkar' => $row['ca_scores_azkar'],
            'cw_scores_azkar' => $row['cw_scores_azkar'],
            'total_scores_azkar' => $row['total_scores_azkar'],
            'obtained_scores_huruf' => $row['obtained_scores_huruf'],
            'exams_scores_huruf' => $row['exams_scores_huruf'],
            'ca_scores_huruf' => $row['ca_scores_huruf'],
            'cw_scores_huruf' => $row['cw_scores_huruf'],
            'total_scores_huruf' => $row['total_scores_huruf'],
            'obtained_scores_muhadatha' => $row['obtained_scores_muhadatha'],
            'exams_scores_muhadatha' => $row['exams_scores_muhadatha'],
            'ca_scores_muhadatha' => $row['ca_scores_muhadatha'],
            'cw_scores_muhadatha' => $row['cw_scores_muhadatha'],
            'total_scores_muhadatha' => $row['total_scores_muhadatha'],
            'obtained_scores_sirrah' => $row['obtained_scores_sirrah'],
            'exams_scores_sirrah' => $row['exams_scores_sirrah'],
            'ca_scores_sirrah' => $row['ca_scores_sirrah'],
            'cw_scores_sirrah' => $row['cw_scores_sirrah'],
            'total_scores_sirrah' => $row['total_scores_sirrah'],
            'grade_quran' => $row['grade_quran'],
            'grade_arabic' => $row['grade_arabic'],
            'grade_hadith' => $row['grade_hadith'],
            'grade_azkar' => $row['grade_azkar'],
            'grade_huruf' => $row['grade_huruf'],
            'grade_muhadatha' => $row['grade_muhadatha'],
            'grade_sirrah' => $row['grade_sirrah'],
        ]);
    }
}
