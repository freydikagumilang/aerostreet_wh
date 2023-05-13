<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initdb extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                            'type' => 'BIGINT',
                            'unsigned' => TRUE,
                            'auto_increment' => TRUE
                        ),
                        'salesorder_id' => array(
                                'type' => 'BIGINT',
                                'unsigned' => TRUE,
                        ),
                        'salesorder_no' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '200',
                        ),
                        'phone' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '200',
                        ),
                        'jubelio_data' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        )
                        
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('jubelio_orders');
        }

        public function down()
        {
                // $this->dbforge->drop_table('jubelio_orders');
        }
}