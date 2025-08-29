<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveIpFromFeedbacks extends Migration
{
    public function up()
    {
        // Drop columns if they exist
        $fields = $this->db->getFieldNames('feedbacks');
        $drop = [];
        if (in_array('ip_address', $fields)) {
            $drop['ip_address'] = ['type' => 'VARCHAR', 'constraint' => 45];
        }
        if (in_array('user_agent', $fields)) {
            $drop['user_agent'] = ['type' => 'TEXT'];
        }
        if (!empty($drop)) {
            $this->forge->dropColumn('feedbacks', array_keys($drop));
        }
    }

    public function down()
    {
        // Re-add columns if needed
        $fields = [];
        $fields['ip_address'] = [
            'type' => 'VARCHAR',
            'constraint' => 45,
            'null' => true,
            'after' => 'status'
        ];
        $fields['user_agent'] = [
            'type' => 'TEXT',
            'null' => true,
            'after' => 'ip_address'
        ];
        $this->forge->addColumn('feedbacks', $fields);
    }
}
