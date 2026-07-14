<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\MemberImportService;

class ImportMembers extends Command
{
    /**
     * php artisan app:import-members
     */
    protected $signature = 'app:import-members';

    protected $description = 'Import legacy members into member_profiles';

    public function handle()
    {
        $file = base_path('backup/members_original.xlsx');

        if (!file_exists($file)) {
            $this->error("Excel file not found : {$file}");
            return self::FAILURE;
        }

        $rows = Excel::toArray([], $file);

        if (empty($rows) || empty($rows[0])) {
            $this->error('Excel file is empty.');
            return self::FAILURE;
        }

        $header = array_map(function ($value) {
            return strtolower(trim($value));
        }, $rows[0][0]);

        $imported = 0;
        $skipped = 0;

        foreach (array_slice($rows[0], 1) as $row) {

            if (count(array_filter($row)) == 0) {
                continue;
            }

            $data = array_combine($header, $row);

try {

    echo "<pre>";
    var_dump($data['join date']);
    echo "</pre>";
    die();

    MemberImportService::import([

        'smart_id'                => trim($data['member id'] ?? ''),
        'full_name'               => trim($data['name'] ?? ''),
        'email'                   => strtolower(trim($data['email'] ?? '')),
        'country_code'            => '+91',
        'mobile'                  => preg_replace('/[^0-9]/', '', $data['phone'] ?? ''),

        'real_sponsor_smart_id'   => trim($data['sponsor'] ?? ''),
        'rising_sponsor_smart_id' => null,

        'password'                => 'Temp@12345',
        'transaction_password'    => 'Txn@12345',

        'terms'                   => true,

        'is_active' => strtolower(trim($data['status'] ?? '')) === 'active',

        'registration_datetime' => !empty($data['join date'])
            ? date('Y-m-d H:i:s', strtotime($data['join date']))
            : null,

        'first_purchase_datetime' => null,

        'is_test_data' => false,

    ]);

    $imported++;
} catch (\Throwable $e) {

    $skipped++;

    echo "<pre>";
    echo $e->getMessage();
    echo "</pre>";
}

}
echo "<h3>Import Finished</h3>";

echo "Imported : {$imported}<br>";

echo "Skipped : {$skipped}<br>";

return self::SUCCESS;
    }

}