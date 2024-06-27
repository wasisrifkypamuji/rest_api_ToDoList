<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserAndKategoriAndTaskAndReminderAndAttachment extends Migration
{
    public function up()
    {
        // Tabel User
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user');

        // Tabel Kategori
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kategori');

        // Tabel Task
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 1028,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'kategori', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('task');

        // Tabel Reminder
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'task_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'reminder_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'reminder_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'message' => [
                'type' => 'VARCHAR',
                'constraint' => 1028,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('task_id', 'task', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reminder');

        // Tabel Attachment
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'task_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'filepath' => [
                'type' => 'MEDIUMBLOB',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('task_id', 'task', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('attachment');
    }

    public function down()
    {
        $this->forge->dropTable('attachment');
        $this->forge->dropTable('reminder');
        $this->forge->dropTable('task');
        $this->forge->dropTable('kategori');
        $this->forge->dropTable('user');
    }
}
