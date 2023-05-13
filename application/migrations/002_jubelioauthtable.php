<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_jubelioauthtable extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'auth_id' => array(
                                'type' => 'BIGINT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'token' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '200',
                        ),
                        'created_at' => array(
                            'type' => 'int',
                            'constraint' => '11',
                        ),
                        
                        
                ));
                $this->dbforge->add_key('auth_id', TRUE);
                $this->dbforge->create_table('jubelio_token');
        }

        public function down()
        {
                // $this->dbforge->drop_table('jubelio_orders');
        }
}