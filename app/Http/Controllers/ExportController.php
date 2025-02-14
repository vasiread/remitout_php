<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{



    public function export()
    {
        // Sample data
        $proposalsInfo = [
            [
                'NBFC' => 'NBFC Name',
                'ProposalDate' => '20/11/2024',
                'Status' => 'Approved'
            ],
            [
                'NBFC' => 'NBFC Name',
                'ProposalDate' => '20/11/2024',
                'Status' => 'Pending'
            ],
        ];

        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $studentDocumentDetailsInfo = [
                ['student_name' => 'Manish', 'DocumentFinalStatus' => 'Missing Documents: 01', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-07-01'],
                ['student_name' => 'Kumar', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2022-02-01'],
                ['student_name' => 'Raji', 'DocumentFinalStatus' => 'Missing Documents: 12', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-12-04'],
                ['student_name' => 'Venkatesh', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-02-01'],
                ['student_name' => 'Ramya', 'DocumentFinalStatus' => 'Missing Documents: 03', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-02-09'],
                ['student_name' => 'Chinna', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-07-20'],
                ['student_name' => 'Feroz', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-02-21'],
                ['student_name' => 'Ramesh', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2022-07-29'],
                ['student_name' => 'Vasi', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2021-09-30'],
                ['student_name' => 'Aari', 'DocumentFinalStatus' => 'Documents: Complete', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2023-10-01'],
                ['student_name' => 'Abinav', 'DocumentFinalStatus' => 'Missing Documents: 02', 'DocumentFinalDate' => '02/11/2024', 'ProposalReceived' => '02', 'TotalDuration' => '3 weeks', 'proposalDetailInfo' => $proposalsInfo, 'date_added' => '2022-07-01'],


            ];

            $sheet->setCellValue('A1', 'Student Name')
                ->setCellValue('B1', 'Document Status')
                ->setCellValue('C1', 'Document Date')
                ->setCellValue('D1', 'Proposal Received')
                ->setCellValue('E1', 'Total Duration')
                ->setCellValue('F1', 'Proposal Info')
                ->setCellValue('G1', 'Date Added');

            $row = 2;
            foreach ($studentDocumentDetailsInfo as $student) {
                $proposalDetails = '';
                foreach ($student['proposalDetailInfo'] as $proposal) {
                    $proposalDetails .= 'NBFC: ' . $proposal['NBFC'] . ', Proposal Date: ' . $proposal['ProposalDate'] . ', Status: ' . $proposal['Status'] . "\n";
                }

                $sheet->setCellValue('A' . $row, $student['student_name'])
                    ->setCellValue('B' . $row, $student['DocumentFinalStatus'])
                    ->setCellValue('C' . $row, $student['DocumentFinalDate'])
                    ->setCellValue('D' . $row, $student['ProposalReceived'])
                    ->setCellValue('E' . $row, $student['TotalDuration'])
                    ->setCellValue('F' . $row, $proposalDetails)
                    ->setCellValue('G' . $row, $student['date_added']);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $filePath = storage_path('app/public/student_document_details.xlsx');
            $writer->save($filePath);

            return response()->download($filePath, 'student_document_details.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while generating the Excel file.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
