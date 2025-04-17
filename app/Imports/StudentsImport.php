<?php
namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    private $skippedRows = 0;
    private $isFirstRow = true;  // Add a flag to detect the first row (header)

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip the header row (first row)
        if ($this->isFirstRow) {
            $this->isFirstRow = false;  // Set flag to false after skipping first row
            return null;  // Skip header row
        }

        $email = $row[1];  // Email is in the second column

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->skippedRows++;
            return null;
        }

        // Check if the email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $this->skippedRows++;  // Skip row if email already exists
            return null;
        }

        // Create a new user record
        return new User([
            'name' => $row[0],
            'email' => $email,
            'phone' => $row[2],
            'password' => Hash::make($row[3]),
        ]);
    }

    /**
     * Get the number of skipped rows
     */
    public function getSkippedRows()
    {
        return $this->skippedRows;
    }
}
