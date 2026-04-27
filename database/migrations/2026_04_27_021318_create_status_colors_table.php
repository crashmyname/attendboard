<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateStatusColorsTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('status_colors');
        $table->id();
        $table->string('code',50)->unique();
        $table->string('name',100);
        $table->string('color_hex',10);
        $table->text('description')->nullable();
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'status_colors' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('status_colors');
        $pdo->exec($table->buildDropSQL());
    }
}
