<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SendWa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        foreach($this->data['notelepon'] as $item){
            $response = Http::post('https://0703-36-77-28-9.ngrok-free.app/pesan', [
                'number' => $item->telp,
                'message' => 'Ada Surat Masuk',
                'file' => $this->data['file']
            ]);
        }
        // DB::table('users')->insert(
        //     [
        //         'name' => 'Super Admin',
        //         'role' => 'superadmin',
        //         'password' => bcrypt('12341234'),
        //         'jenis_kelamin' => 'laki-laki',
        //         'alamat' => 'Tasikmalaya',
        //         'username' => 'superadmin2',
        //         'id_unit_kerja' => '1',
        //         'telp' => '098876532456',
        //     ],
        // );
    }
}
