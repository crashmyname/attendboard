<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreatePeriodsTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('periods');
        $table->id();
        $table->string('name', 100);
        $table->date('start_date');
        $table->date('end_date');
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'periods' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('periods');
        $pdo->exec($table->buildDropSQL());
    }
}
