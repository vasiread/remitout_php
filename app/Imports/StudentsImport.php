<?php
namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    private $skippedRows = 0;
    private $isFirstRow = true;
    private $referralId;

    public function __construct($referralId = null)
    {
        $this->referralId = $referralId;
    }

    public function model(array $row)
    {
        if ($this->isFirstRow) {
            $this->isFirstRow = false;
            return null;
        }

        $email = $row[1];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->skippedRows++;
            return null;
        }

        if (User::where('email', $email)->exists()) {
            $this->skippedRows++;
            return null;
        }

        return new User([
            'name' => $row[0],
            'email' => $email,
            'phone' => $row[2],
            'password' => Hash::make($row[3]),
            'referral_code' => $this->referralId, // <- Add this
        ]);
    }

    public function getSkippedRows()
    {
        return $this->skippedRows;
    }
}

