<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * php artisan app:import-members
     */
    protected $signature = 'app:import-members';

    /**
     * The console command description.
     */
    protected $description = 'Import members from storage/app/members.xlsx';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = storage_path('app/members.xlsx');

        if (!file_exists($file)) {
            $this->error("File not found: " . $file);
            return Command::FAILURE;
        }

        $rows = Excel::toArray([], $file);

        if (empty($rows) || empty($rows[0])) {
            $this->error('Excel file is empty.');
            return Command::FAILURE;
        }

        $header = array_map(function ($value) {
            return strtolower(trim($value));
        }, $rows[0][0]);

        $count = 0;

        foreach (array_slice($rows[0], 1) as $row) {

            if (count(array_filter($row)) == 0) {
                continue;
            }

            $data = array_combine($header, $row);

            User::updateOrCreate(
                [
                    'email' => strtolower(trim($data['email'] ?? ''))
                ],
                [
                    'smart_id' => $data['member_id'] ?? null,
                    'name' => trim($data['name'] ?? ''),
                    'mobile' => preg_replace('/[^0-9]/', '', $data['phone'] ?? ''),
                    'sponsor_id' => $data['sponsor'] ?? null,
                    'password' => bcrypt('12345678'),
                ]
            );

            $count++;
        }

        $this->info("Imported {$count} members successfully.");

        return Command::SUCCESS;
    }
}