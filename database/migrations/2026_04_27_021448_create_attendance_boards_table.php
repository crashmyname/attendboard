<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateAttendanceBoardsTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('attendance_boards');
        $table->id();
        $table->string('nik',8)->unique();
        $table->string('employee_name',150);
        $table->string('department',100);
        $table->string('section',100);
        $table->string('position',100);
        $table->bigInteger('period_id');
        $table->string('jobdesc',255);
        $table->bigInteger('attendance_status_id');
        $table->bigInteger('atcivity_status_id');
        $table->date('attendance_date');
        $table->text('note')->nullable();
        $table->decimal('overtime_hours','5,2');
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'attendance_boards' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('attendance_boards');
        $pdo->exec($table->buildDropSQL());
    }
}
