<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_home_hero MODIFY badge TEXT NULL, MODIFY judul TEXT NULL, MODIFY btn_booking TEXT NULL, MODIFY btn_destinasi TEXT NULL, MODIFY stat_destinasi_angka TEXT NULL, MODIFY stat_destinasi_label TEXT NULL, MODIFY stat_armada_angka TEXT NULL, MODIFY stat_armada_label TEXT NULL, MODIFY stat_rating_angka TEXT NULL, MODIFY stat_rating_label TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_home_penawaran MODIFY eyebrow TEXT NULL, MODIFY judul TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_home_cta MODIFY judul TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_home_footer MODIFY judul TEXT NULL, MODIFY copyright TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_about_hero MODIFY badge TEXT NULL, MODIFY judul TEXT NULL, MODIFY stat_1_angka TEXT NULL, MODIFY stat_1_label TEXT NULL, MODIFY stat_2_angka TEXT NULL, MODIFY stat_2_label TEXT NULL, MODIFY stat_3_angka TEXT NULL, MODIFY stat_3_label TEXT NULL, MODIFY stat_4_angka TEXT NULL, MODIFY stat_4_label TEXT NULL, MODIFY badge_premium TEXT NULL, MODIFY caption TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_kisah MODIFY badge TEXT NULL, MODIFY judul TEXT NULL, MODIFY badge_text TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_visimisi MODIFY badge TEXT NULL, MODIFY judul TEXT NULL;');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE sect_nilai MODIFY badge TEXT NULL, MODIFY judul TEXT NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For brevity in rollback, we can just leave it as text or convert it back to varchar(255).
        // It's safer to leave it as TEXT during rollback to prevent data loss.
    }
};
