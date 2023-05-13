<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_campaign extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'BIGINT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'campaign_name' => array(
                            'type' => 'VARCHAR',
                            'constraint' => '200',
                        ),
                        'campaign_start_date' => array(
                            'type' => 'int',
                            'constraint' => '11',
                        ),
                        'campaign_end_date' => array(
                            'type' => 'int',
                            'constraint' => '11',
                        ),
                        'created_at' => array(
                            'type' => 'int',
                            'constraint' => '11',
                        ),
                        
                        
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('campaign');
                $ssql = "insert into campaign (campaign_name,campaign_start_date,campaign_end_date,created_at)
                select 'Undian Vespa GTS 150 iGet',unix_timestamp('2023-03-17 00:00:00'),
                unix_timestamp('2023-03-17 23:59:59'),unix_timestamp();";
                $this->db->query($ssql);
        }

        public function down()
        {
                // $this->dbforge->drop_table('jubelio_orders');
        }
}