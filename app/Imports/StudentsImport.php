<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Scuser;
use App\Models\Nbfc;
use App\Models\Admin;
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

        $name = trim($row[0] ?? '');
        $email = trim($row[1] ?? '');
        $phone = trim($row[2] ?? '');
        $password = trim($row[3] ?? '');

        if (
            !$name || !$email || !$password ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            $this->emailExistsAnywhere($email)
        ) {
            $this->skippedRows++;
            return null;
        }

        return new User([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => Hash::make($password),
            'referral_code' => $this->referralId,
        ]);
    }

    private function emailExistsAnywhere($email)
    {
        return User::where('email', $email)->exists() ||
            Scuser::where('email', $email)->exists() ||
            Nbfc::where('nbfc_email', $email)->exists() ||
            Admin::where('email', $email)->exists();
    }

    public function getSkippedRows()
    {
        return $this->skippedRows;
    }
}
