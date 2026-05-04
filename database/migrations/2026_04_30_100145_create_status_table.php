<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateStatusTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('status');
        $table->id();
        $table->string('nik');
        $table->string('name');
        $table->date('date');
        $table->string('status')->nullable();
        $table->string('description')->nullable();
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'status' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('status');
        $pdo->exec($table->buildDropSQL());
    }
}
